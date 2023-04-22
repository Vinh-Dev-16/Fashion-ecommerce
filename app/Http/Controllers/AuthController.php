<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Validator,Redirect,Response,File;
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
        event(new Registered($user));
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            switch (Auth::user()->role_id) {
                case (2):
                    return redirect('admin/dashboard');
                    break;
                case (3):
                    return redirect('admin/dashboard');
                    break;
                case (4):
                    return redirect('/');
                    break;
                case (1):
                    return redirect('/');
                    break;
            }
        } else {
            return redirect('/login')->with('error', 'Mật khẩu hoặt email không đúng');
        }
    }



    public function logout()
    {

        Auth::logout();
        return redirect()->to(route('login'));
    }

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
      
        $getInfo = Socialite::driver($provider)->user(); 
        $user = $this->createUser($getInfo,$provider); 
        auth()->login($user); 
        return redirect()->to('/');
      }
      function createUser($getInfo,$provider){
      $user = User::where('provider_id', $getInfo->id)->first();
      if (!$user) {
           $user = User::create([
              'name'     => $getInfo->name,
              'email'    => $getInfo->email,
              'provider' => $provider,
              'provider_id' => $getInfo->id
          ]);
        }
        return $user;
      }
}
