<?php

namespace App\Http\Controllers;

use App\Jobs\sendMail;
use App\Models\VerifyEmail;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|same:password'
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'min' => 'Mật khẩu tối thiểu phải 6 kí tự',
                'confirmed' => 'Mật khẩu nhập phải trùng khớp',
                'email' => 'Phải nhập đúng định dạng email',
                'same:password' => 'Mật khẩu nhập phải trùng khớp',
                'unique:users' => 'Đã bị trùng email',
            ];
            $request->validate($rules, $messages);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => 'Không được để trống trường này',
            'email' => 'Phải nhập đúng định dạng email',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 0,
                    'message' => $validator->errors()->toArray(),
                ],
                200
            );
        }
        try {
            $remember = $request->remember_me == 1 ? true : false;
            $credentials = request(['email', 'password']);
            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();
                if ($user->email_verified_at == null) {
                    $this->sendOTP($user);
                    return response()->json(
                        [
                            'status' => 1,
                            'message' => 'Tài khoản chưa được xác thực',
                            'view' => view('verify', compact('user'))->render(),
                        ],
                        200
                    );
                } else {
                    if ($user->hasRole('user','shipper')) {
                        return response()->json(
                            [
                                'status' => 2,
                                'message' => 'Đăng nhập thành công',
                            ],
                            200
                        );
                    } else {
                        return response()->json(
                            [
                                'status' => 4,
                                'message' => 'Đăng nhập thành công',
                            ],
                            200
                        );
                    }
                }
            } else {
                return response()->json(
                    [
                        'status' => 3,
                        'message' => 'Email hoặc mật khẩu không đúng',
                    ],
                    200
                );
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Đã xảy ra lỗi');
        }


    }

    public function sendOTP($user): void
    {
        $otp = rand(100000, 999999);
        $time = time();

        $verifyEmail = VerifyEmail::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'otp' => $otp,
                'user_id' => $user->id,
                'set_up_time' => $time,
            ]
        );
        $data = [
            'title' => 'Mã OTP của FASHION',
            'body' => 'Mã OTP của bạn là:' . $otp,
        ];
        sendMail::dispatch($data, $user)->delay(now()->addSecond(6));
    }
    public function verifiedOTP(Request $request) {
        $user = User::where('email' , '=', $request->email)->first();

        if (!( VerifyEmail::where('otp' , $request->otp)->first())) {
            return response()->json(['success' => false, 'message' => 'Nhập sai mã  OTP']);
        } else {
            $otpData =  VerifyEmail::where('otp' , $request->otp)->first();
            $currentTime = time();
            $time = $otpData->setup_time;
            if ($currentTime >= $time && $time >= $currentTime - (90+5) ) {
                if (Session::get('password')) {
                    $user->update([
                        'password' => Hash::make(session('password')),
                        'email_verify_at' => with(Carbon::now())->toDateTimeString(),
                    ]);
                    session()->forget('password');
                } else {
                    $user->update([
                        'email_verify_at' => with(Carbon::now())->toDateTimeString(),
                    ]);
                }
                $user->save();
                if ($user->hasRole('user')) {
                    return response()->json(
                        [
                            'success' => true,
                            'message' => 'Đã xác thực thành công',
                            'role' => 'user',
                        ]);
                } else {
                    return response()->json(
                        [
                            'success' => true,
                            'message' => 'Đã xác thực thành công',
                            'role' => 'other',
                        ]);
                }
            }else {
                return response()->json(['success' => false, 'message' => 'Đã quá thời gian']);
            }
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {

        Auth::logout();
        return redirect()->to(route('login'));
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);
        return redirect()->to('/');
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
