<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Auth;

class AdminLoginController extends Controller
{

    use ThrottlesLogins;

    public function username(){
        return 'email';
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if ($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }

        $this->incrementLoginAttempts($request);

        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        $request->validate($rules,$messages);
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }
}
