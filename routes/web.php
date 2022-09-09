<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\ProductController;

// Guest
Route::match(['get'], '/', function(){return redirect('home');});
Route::match(['get'], '/home', [HomeController::class, 'gethomepage'])->name('home');
// Route::match(['get'], '/search/{keyword}', [SearchController::class, 'search'])->name('search');
// Route::match(['get'], '/product/{id}', [ProductController::class, 'getproductpage'])->name('viewproduct');
Route::resource('product', ProductController::class)->except([
    'create', 'store', 'update', 'destroy', 'index'
]);

// User_Auth
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');


