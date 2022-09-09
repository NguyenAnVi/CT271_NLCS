<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.auth.login');
        }

        // $credentials = $request->only(['email', 'password']);
        $credentials = $request->only(['phone', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            echo("<script>console.log(Auth.error);</script>");
            return back()->withInput();
        }
    }

    public function register(Request $request)
    {
        if($request->getMethod() == 'GET') {
            return view('user.auth.register');
        }
        $credentials = $request->only(['name', 'phone', 'password']);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10|unique:users',
            // 'email' => 'required|string|email|max:255',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            // 'email' => $request['email'],
            // 'address' => $request['address'],
            // 'password' => Hash::make($input['password']),
            'password' => Hash::make($request->input('password')),
            'point' => 0,
        ]);
        $data=([
            'general_message' => 'Tạo tài khoản thành công.',
            'general_message_type' => 'success',
        ]);
        return view('user.auth.login', $data);
    }
    // public function register(Request $request)
    // {
    //     if($request->getMethod() == 'GET') {
    //         return view('user.auth.register');
    //     }
    //     $credentials = $request->only(['name', 'email', 'password']);
        
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required',
    //     ]);
        
    //     return User::create([
    //         'ND_ten' => $request['name'],
    //         'ND_email' => $request['email'],
    //         // 'password' => Hash::make($input['password']),
    //         'ND_matKhau' => Hash::make($request['password']),
    //     ]);
    // }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('home');
    }
}

