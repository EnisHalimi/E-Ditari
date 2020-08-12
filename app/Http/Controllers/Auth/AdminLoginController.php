<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validator($request);

        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }

        return $this->loginFailed();
    }

    public function logout()
    {

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
