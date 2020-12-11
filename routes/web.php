<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVendorController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\DashboardController;

Route::group(['middleware' => ['guest']],function(){

    Route::get('/', function () {
        return view('auth/login');
    });
    
});
Route::group([ 'middleware' => ['auth:sanctum' ,'verified']], function(){
    Route::get('/', [DashboardController::class, 'index']);
    //dashboard item routes
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/short-items', [DashboardController::class, 'show_items']);

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


    // Route::resource('products', ProductController::class);
    // product routes
    Route::get('products', [ProductController::class, 'index']);
    Route::get('show-products', [ProductController::class, 'show']);
    Route::get('add-product', [ProductController::class, 'create']);
    Route::post('save-product', [ProductController::class, 'store']);
    Route::get('edit-product', [ProductController::class, 'edit']);
    Route::post('update-product', [ProductController::class, 'update']);
    Route::post('delete-product', [ProductController::class, 'destroy']);

    Route::get('update-product-stock', [ProductStockController::class, 'index']);
    Route::post('update-product-stock', [ProductStockController::class, 'store']);

    // Route::get('products', function () {
    //     return view('pages.products');
    // });
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
