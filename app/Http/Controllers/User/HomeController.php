<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     echo 'Xin chào User, '. $user->name;
    // }
    public function gethomepage(){
        $data = ([
            // 'general_message'=>'Một thông điệp',
            // 'general_message_type'=>'primary|success|warning|danger'
            'cart_item'=>[
                [
                    'id'=>1,
                    'name'=>'Paracetamol 500mg vi 10 vien',
                    'quantity'=> 3,
                ],
                [
                    'id'=>2,
                    'name'=>'Benda500 1 vien',
                    'quantity'=> 5,
                ],
                [
                    'id'=>3,
                    'name'=>'asdadsas 1 vien',
                    'quantity'=> 5,
                ],
            ],
        ]);
        return view('tested', $data);
    }
    public function showProduct(Product $product)
    {
        //
    }
}

