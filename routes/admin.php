
<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('admin.login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function (){
    Route::prefix('')->group(function (){
        Route::match(['get', 'post'], 'register', [LoginController::class, 'register'])->name('admin.register');
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::get('', function(){return redirect()->route('admin.home');});

        Route::match(['get', 'post'],'confirm-password', [LoginController::class, 'confirm_password'])->name('password.confirm');

        
        
        Route::resource('product', AdminProductController::class)->except(['show']);
    });
});