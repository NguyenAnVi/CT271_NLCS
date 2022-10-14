<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    public function gethomepage(){
        return view('user.home');
    }
    public function showProduct(Product $product)
    {
        //
    }
}

