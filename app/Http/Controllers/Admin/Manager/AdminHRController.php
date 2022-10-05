<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminHRController extends Controller
{
    public function getCurrentId(){
        return Auth::guard('admin')->user()->id;
    }
    public function rejectAction(){
        //return an message reject permision to a page
        $data = ([
            'danger' => 'Your account don\'t have enough permission to do this action.', 
        ]);
        return redirect()->route('admin.home')->withErrors($data);
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
    //     return $this->rejectAction();
    // }
    //////////////////////////////////////////////////////////
        
    public function index($data=NULL)
    {
        $check = $this->checkRootUser($this->getCurrentId());
        $admins = DB::table('admins')->paginate(5);
        if($check){
            if($data!=NULL) $data = array_merge($data,['admins' => $admins,]);
            else $data = (['admins' => $admins,]);
            return view('admin.hr.index', $data);
        }
        else{
            return $this->rejectAction();
        }
        
    }

    public function create()
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            return view('admin.hr.create');
        }
        else{
            return $this->rejectAction();
        }
    }

    public function store(Request $request)
    {   
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //if the User is ROOT
            $credentials = $request->only(['name', 'phone', 'password', 'password_confirm']);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|size:10|unique:admins',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ],$messages = [
                'name.required' => 'Bạn cần nhập tên',
                'name.max' => 'Tên nhân viên không vượt quá :max kí tự.',
                'phone.unique' => 'Số điện thoại đã tồn tại.',
                'phone.size' => 'Số điện thoại phải có đúng 10 chữ số.',
                'password.required' => 'Mật khẩu là cần thiết!!!',
                'password.min' => 'Để an toàn hơn, hãy đặt mật khẩu từ 6 kí tự trở lên.',
                'password_confirmation.required' => 'Cần phải nhập lại mật khẩu.',
                'password_confirmation.same' => 'Nhập lại mật khẩu sai, chắc chưa?',
            ]);
            Admin::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
            ]);
            return redirect()->route('admin.hr')->withErrors(['success'=>'Tạo tài khoản thành công.']);
        }
        else{
            return $this->rejectAction();
        }
    }

    public function edit($id)
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            // $admin = Admin::find($id);
            $admin = Admin::where('id', $id)->first();
            if (! $admin) {
                return $this->notFound();                       
            }
            $data = ([
                'admin' => $admin,
            ]);
            return view('admin.hr.edit', $data);
        }
        else{
            return $this->rejectAction();
        }
        
    }

    public function update(Request $request, $id)
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            // Ngăn ngừa tấn công CSRF
            $this->invokeCsrfGuard();

            // Kiểm tra xem id có tồn tại hay không?
            $admin = Admin::find($id);
            if (! $admin) {
                return $this->notFound();                       
            }
            else{
                // $credentials = $request->only(['name', 'phone', 'password']);
                $validated = FALSE;
                $admin = Admin::find($id);
                $fields = '';
                if($request->boolean('name_check')){
                    $validated = $request->validate(['name' => 'required|string|max:255']);
                    $fields = $fields.'`họ tên` ';
                    $admin->name = $request->input('name');
                    
                }
                if($request->boolean('phone_check')){
                    if ($request->input('phone') != $admin->phone){
                        $validated = $request->validate(['phone' => 'required|string|max:10|min:10|unique:admins']);
                        $fields = $fields.'số điện thoại, ';
                        $admin->phone = $request->input('phone');
                    }
                }
                if($request->boolean('password_check')){
                    
                    $validated = $request->validate(['password' => 'required|min:6']);
                    $fields = $fields.'mật khẩu mới ';
                    $admin->password = Hash::make($request->input('password'));
                }

                $admin->save();
                return redirect()->route('admin.hr')->withErrors(([
                    'success'=> $fields.' đã được cập nhật.'
                ]));
                
            }

            
            
        }
        else{
            return $this->rejectAction();
        }
    }

    public function destroy($id)
    {
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            unset($check);
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
                'success'=> 'Đã xóa thành công '.$admin->name.'.'
            ]));
        }
        else{
            unset($check);
            return $this->rejectAction();
        }
    }
}
