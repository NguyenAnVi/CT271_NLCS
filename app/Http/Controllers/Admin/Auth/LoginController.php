<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SessionGuard as Guard;
use App\Csrf;
use App\Models\Admin as User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if(!Auth::guard('admin')->user()){
                return view('admin.auth.login');
            }
            else{
                $data = ([
                    'any' => 'Bạn đã đăng nhập với tên '.Auth::guard('admin')->user()->name,
                ]);
                return redirect()->route('admin.home')->withErrors($data);
            }
        }
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only(['phone', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            Csrf::generateToken();
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->withInput()->withErrors(([
                'approve' => 'Số điện thoại hoặc mật khẩu sai'
            ]));
        }
    }

    public static function logout(Request $request){
        Guard::logout($request);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.home');
    }


}
    