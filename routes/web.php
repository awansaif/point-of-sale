<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVendorController;


Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group([ 'middleware' => 'auth' ], function(){
    Route::resource('product-vendors', ProductVendorController::class);
    Route::resource('product-brands', ProductBrandController::class);
    Route::get('product-types', [ProductTypeController::class, 'index']);
    Route::get('edit-product-type', [ProductTypeController::class, 'edit']);
    Route::post('update_product_type', [ProductTypeController::class, 'update']);
    Route::post('add-product-type', [ProductTypeController::class, 'store']);
    Route::resource('products', ProductController::class);
    Route::get('retail-dashboard', function () {
        return view('pages.retail-dashboard');
    });
    Route::get('sales-reports', function () {
        return view('pages.sales-reports');
    });
    Route::get('inventory-reports', function () {
        return view('pages.inventory-reports');
    });
    Route::get('payment-reports', function () {
        return view('pages.payment-reports');
    });
    Route::get('sales', function () {
        return view('pages.sales');
    });
    Route::get('export-record', function () {
        return view('pages.export-record');
    });

    Route::get('history', function () {
        return view('pages.history');
    });

    //detail pages
    Route::get('revenue', function () {
        return view('pages.revenue');
    });
    Route::get('sales-count', function () {
        return view('pages.sales-count');
    });
    // 
    //routers
    
});
