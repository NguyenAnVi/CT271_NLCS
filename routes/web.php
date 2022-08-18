<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');
Route::middleware('auth')->group(function (){
    Route::prefix('/admin')->group(function (){
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin_home');
        Route::match(['get', 'post'], '/login', [AdminLoginController::class, 'login'])->name('admin_login');
        Route::match(['get', 'post'], '/register', [AdminLoginController::class, 'register'])->name('admin_register');
    });
});