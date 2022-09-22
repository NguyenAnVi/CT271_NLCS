<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminCustomerController extends Controller
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
        
    public function index($data=NULL){
        $check = $this->checkRootUser($this->getCurrentId());
        $users = DB::table('users')->paginate(5);
        if($check){
            if($data!=NULL) $data = array_merge($data,['users' => $users,]);
            else $data = (['users' => $users,]);
            return view('admin.customer.index', $data);
        }
        else{
            return $this->rejectAction();
        }
        
    }

    public function edit($id){
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            $user = User::where('id', $id)->first();
            if (! $user) {
                return $this->notFound();                       
            }
            $data = ([
                'user' => $user,
            ]);
            return view('admin.customer.edit', $data);
        }
        else{
            return $this->rejectAction();
        }
        
    }

    public function update(Request $request, $id){
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            //do something if the User is ROOT
            // Ngăn ngừa tấn công CSRF
            $this->invokeCsrfGuard();

            // Kiểm tra xem id có tồn tại hay không?
            $user = User::find($id);
            if (! $user) {
                // return $this->notFound();
                return view('tested', ['msg'=>$user]);
            }
            else{
                // $credentials = $request->only(['name', 'phone', 'password']);
                $validated = FALSE;
                $user = User::find($id);
                $fields = '';
                if($request->boolean('name_check')){
                    $validated = $request->validate(['name' => 'required|string|max:255']);
                    $fields = $fields.'`họ tên` ';
                    $user->name = $request->input('name');
                    
                }
                if($request->boolean('phone_check')){
                    if ($request->input('phone') != $user->phone){
                        $validated = $request->validate(['phone' => 'required|string|max:10|min:10|unique:admins']);
                        $fields = $fields.'số điện thoại, ';
                        $user->phone = $request->input('phone');
                    }
                }
                if($request->boolean('password_check')){
                    
                    $validated = $request->validate(['password' => 'required|min:6']);
                    $fields = $fields.'mật khẩu mới ';
                    $user->password = Hash::make($request->input('password'));
                }

                $user->save();
                return redirect()->route('admin.customer')->withErrors(([
                    'success'=> $fields.' đã được cập nhật.'
                ]));
                
            }

            
            
        }
        else{
            return $this->rejectAction();
        }
    }

    public function destroy($id){
        $check = $this->checkRootUser($this->getCurrentId());
        if($check){
            unset($check);
            //do something if the User is ROOT
            // Ngăn ngừa tấn công CSRF
            $this->invokeCsrfGuard();

            // Kiểm tra xem id có tồn tại hay không?
            $user = User::find($id);
            if (! $user) {
                $this->notFound();                       
            }

            // Thực hiện xóa contact...
            $user->delete();
            return redirect()->route('admin.customer')->withErrors(([
                'success'=> 'Đã xóa thành công '.$user->name.'.'
            ]));
        }
        else{
            unset($check);
            return $this->rejectAction();
        }
    }
}
