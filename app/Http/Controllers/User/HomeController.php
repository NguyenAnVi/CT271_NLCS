<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Controllers\User\Resources\ProductController;
use App\Http\Controllers\User\Resources\SaleoffController;

class HomeController extends Controller
{
	public function gethomepage(){

		$data = ([
			'saleoffs' => SaleoffController::getSaleoffs(),
			'categories' => Category::get(),
			'products' => ProductController::getProducts(6),
		]);
		return view('user.home', $data);
	}
	public function show($what, $id)
	{
		switch($what){
			case 'product':
				$data = ([
					'item' => ProductController::getProduct($id),
					'view' => 'user.show.product',
				]);
				return view('user.show', $data);
				break;
			case 'category':
				//
				break;
			case 'saleoff':
				//
				break;
			default:
				//
		};

		return;
	}

	public function notFound(){
		return view('user.errors.404');
	}
}

