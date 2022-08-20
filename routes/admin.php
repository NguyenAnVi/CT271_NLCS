
<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:admin')->group(function (){
//     Route::get('/', [HomeController::class, 'index'])->name('dashboard');
// });
Route::middleware('auth')->group(function (){
    Route::prefix('/admin')->group(function (){
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');
        Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
        Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('admin.register');
    });
});