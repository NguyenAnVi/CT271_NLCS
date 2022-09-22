
<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Manager\AdminHRController;
use App\Http\Controllers\Admin\Manager\AdminCustomerController;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use App\Http\Controllers\Admin\Manager\AdminSaleOffController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('admin.login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function (){
    Route::prefix('')->group(function (){
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::get('', function(){return redirect()->route('admin.home');});

        // Manage Admin Account route
        Route::match(['get', 'post'], 'hr', [AdminHRController::class, 'index'])->name('admin.hr');
        Route::match(['post'], 'hr/create', [AdminHRController::class, 'createNewAccount'])->name('admin.hr.create');
        Route::match(['delete'], 'hr/destroy/{id}', [AdminHRController::class, 'destroy'])->name('admin.hr.destroy');
        Route::match(['get'], 'hr/edit/{id}', [AdminHRController::class, 'edit'])->name('admin.hr.edit');
        Route::match(['post'], 'hr/update/{id}', [AdminHRController::class, 'update'])->name('admin.hr.update');

        // Manage User Account route
        Route::resource('customer', AdminCustomerController::class)
            ->except(['show', 'create', 'store'])
            ->names([
                'index' => 'admin.customer',
                'edit' => 'admin.customer.edit',
                'update' => 'admin.customer.update',
                'destroy' => 'admin.customer.destroy'
            ]);

        // Manage SaleOff route
        Route::resource('product', AdminSaleOffController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.saleoff',
                'create' => 'admin.saleoff.create',
                'store' => 'admin.saleoff.store',
                'edit' => 'admin.saleoff.edit',
                'update' => 'admin.saleoff.update',
                'destroy' => 'admin.saleoff.destroy'
            ]);

        Route::resource('product', AdminProductController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.product',
                'create' => 'admin.product.create',
                'store' => 'admin.product.store',
                'edit' => 'admin.product.edit',
                'update' => 'admin.product.update',
                'destroy' => 'admin.product.destroy'
            ]);
        
    });
});
