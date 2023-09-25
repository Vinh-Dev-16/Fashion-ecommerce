<?php

namespace App\Http\Controllers;

use App\Http\Requests\forgotPasswordRequest;
use App\Jobs\sendMail;
use App\Models\Role;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ],
            [
                'required' => 'Không được để trống trường này',
                'min' => 'Mật khẩu tối thiểu phải 6 kí tự',
                'email' => 'Phải nhập đúng định dạng email',
                'email.unique' => 'Đã bị trùng email',
                'name.unique' => 'Đã bị trùng tên đăng nhập',
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
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
           $user->roles()->attach(Role::where('name', 'user')->first());
            return response()->json(
                [
                    'status' => 2,
                    'message' => 'Đăng kí thành công',
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Đã xảy ra lỗi',
                ],
                200
            );
        }

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
                    if (!$user->can('view-dashboard')) {
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

    public function verifiedOTP(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if (!(VerifyEmail::where('otp', $request->otp)->first())) {
            Auth::logout();
            return response()->json(['success' => false, 'message' => 'Nhập sai mã  OTP']);
        } else {
            $otpData = VerifyEmail::where('otp', $request->otp)->first();
            $currentTime = time();
            $time = $otpData->set_up_time;
            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) {
                if (Session::get('password')) {
                    $user->update([
                        'password' => Hash::make(session('password')),
                    ]);
                    session()->forget('password');
                    return [
                        'status' => 1,
                        'message' => 'Đã đổi mật khẩu thành công',
                    ];
                } else {
                    $user->email_verified_at = with(Carbon::now())->toDateTimeString();
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
            } else {
                Auth::logout();
                return response()->json(['success' => false, 'message' => 'Đã quá thời gian']);
            }
        }
    }

    public function reSendOTP(Request $request): array
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        $otpData = VerifyEmail::where('email', $email)->first();
        $currentTime = time();
        $time = $otpData->set_up_time;

        if ($currentTime >= $time && $time >= $currentTime - (90+5) ) {
            return [
                'status' => 0,
                'message' => 'Thời gian chờ giữa 2 lần gửi OTP là 90s',
            ];
        } else {
            $this->sendOTP($user);
            return [
                'status' => 1,
                'message' => 'Gửi lại mã OTP thành công',
                'view' => view('verify', compact('user'))->render(),
            ];
        }
    }

    public function forgotPassword(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('forgot_password');
    }

    public function handleForgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
        ], [
            'email.required' => 'Không được để trống trường email này',
            'email' => 'Phải nhập đúng định dạng email',
            'password.required' => 'Không được để trống trường mật khẩu này',
            'password.min' => 'Mật khẩu tối thiểu phải 6 kí tự',
            're_password.required' => 'Không được để trống trường nhập lại mật khẩu này',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
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
        $user = User::where('email', $request->email)->first();
        if ($user) {
            session(['password' => $request->password]);
            $this->sendOTP($user);
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Gửi mã OTP thành công',
                    'view' => view('verify', compact('user'))->render(),
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 2,
                    'message' => 'Email không tồn tại',
                ],
                200
            );
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
