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
    
    // product type routes
    Route::get('product-types', [ProductTypeController::class, 'index']);
    Route::get('show-product-types', [ProductTypeController::class, 'show']);
    Route::get('edit-product-type', [ProductTypeController::class, 'edit']);
    Route::post('update_product_type', [ProductTypeController::class, 'update']);
    Route::post('add-product-type', [ProductTypeController::class, 'store']);
    Route::get('delete-product-type', [ProductTypeController::class, 'destroy']);
    
    //product brand routes
    Route::get('product-brands', [ProductBrandController::class, 'index']);
    Route::get('show-product-brands', [ProductBrandController::class, 'show']);
    Route::post('add-product-brand', [ProductBrandController::class, 'store']);
    Route::get('edit-product-brand', [ProductBrandController::class, 'edit']);
    Route::post('update-product-brand', [ProductBrandController::class, 'update']);
    Route::post('delete-product-brand', [ProductBrandController::class, 'destroy']);

    // product vendor route
    Route::get('product-vendors', [ProductVendorController::class, 'index']);
    Route::get('show-product-vendors', [ProductVendorController::class, 'show']);
    Route::post('add-product-vendor', [ProductVendorController::class, 'store']);
    Route::get('edit-product-vendor', [ProductVendorController::class, 'edit']);
    Route::post('update-product-vendor', [ProductVendorController::class, 'update']);
    Route::post('delete-product-vendor', [ProductVendorController::class, 'destroy']);
    //Route::resource('products', ProductController::class);
    Route::get('products', function () {
        return view('pages.products');
    });
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
