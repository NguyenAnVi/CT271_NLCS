<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin as User;

class LoginController extends Controller
{
    private const adminpassword = "DY!q6EuRJw";
    
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.login');
        }
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only(['phone', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->withInput()->withErrors(([
                'approve' => 'Số điện thoại hoặc mật khẩu sai'
            ]));
        }
    }

    public function register(Request $request)
    {
        Auth::guard('admin')->check();
        if($request->getMethod() == 'GET') {
            return view('admin.auth.register');
        }
        $credentials = $request->only(['name', 'phone', 'password']);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10|unique:admins',
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
        return view('admin.auth.login', $data);
    }
   
    public function logout(Request $request){
        Auth::guard('admin')->logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('admin.home');
    }

    public function confirm_password(Request $request){
        if($request->getMethod() == 'GET') {
            return view('auth.confirm-password');
        }
        // else
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }
     
        $request->session()->passwordConfirmed();
     
        return redirect()->intended();
    }

}
    