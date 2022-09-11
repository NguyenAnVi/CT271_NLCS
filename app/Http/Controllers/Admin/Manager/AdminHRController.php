<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SessionGuard as Guard;


class AdminHRController extends Controller
{
    public function getCurrentId(){
        return Auth::guard('admin')->user()->id;
    }
    public function getAdminData(){
        return Admin::all('*');
    }

    public function checkRootUser($id){
        if($id === 1 ){
            return true;
        }
        else{
            return false;
        }
    }
    /////////////////// using checkRootUser/////////////////
    // $check = $this->checkRootUser($this->getCurrentId());
    // if($check){
    //     //do something if the User is ROOT
    // }
    // else{
    //     //return an message reject permision to a page
    // $data = ([
    //     'any' => 'Your account don\'t have enough permission to do this action.', 
    // ]);
    // return redirect()->route('admin.home')->withErrors($data);
    // }
    //////////////////////////////////////////////////////////
        
    public function index()
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            $data = ([
                'admins' => $this->getAdminData(),
                'currentid' => $this::getCurrentId(),
            ]);
            return view('admin.hr.index', $data);
        }
        else{
            // return view('tested', ['msg' => 'checkRootUser => else']);
            $data = ([
                'any' => 'Your account don\'t have enough permission to do this action.', 
            ]);
            return redirect()->route('admin.home')->withErrors($data);
        }
        
    }

    public function createNewAccount(Request $request)
    {   
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            $credentials = $request->only(['name', 'phone', 'password', 'password_confirm']);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:10|min:10|unique:admins',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ]);
            Admin::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
            ]);
            $data=([
                'general_message' => 'Tạo tài khoản thành công.',
                'general_message_type' => 'success',
                'admins' => $this->getAdminData(),
            ]);
            return view('admin.hr.index', $data);
        }
        else{
            //return an message reject permision to a page
            $data = ([
                'any' => 'Your account don\'t have enough permission to do this action.', 
            ]);
            return redirect()->route('admin.home')->withErrors($data);
        }
        
    }

    

    public function create($request)
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy($id)
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            // Ngăn ngừa tấn công CSRF
            $this->invokeCsrfGuard();

            // Kiểm tra xem id có tồn tại hay không?
            $admin = Admin::find($id);
            if (! $admin) {
                $this->notFound();                       
            }

            // Thực hiện xóa contact...
            $admin->delete();
            return redirect()->route('admin.hr')->withErrors(([
                'success'=> 'Contact has been deleted successfully.'
            ]));
        }
        else{
            //return an message reject permision to a page
            $data = ([
                'general_message' => 'Your account don\'t have enough permission to do this action.', 
                'general_message_type' => 'danger'
            ]);
            return view('admin.home', $data);
        }
        
    }
}
