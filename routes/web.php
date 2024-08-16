<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TempPur_Controller;
use App\Http\Controllers\TempSale_Controller;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



//Login Route Start----------------------------------------------------------------
    Route::controller(UserController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('create_account', 'create_account')->name('create_account');
        Route::post('account_save', 'account_save')->name('account_save');
        Route::post('login_check', 'login_check')->name('login_check');
        Route::get('logout', 'logout')->name('logout');
    });
//Login Route End----------------------------------------------------------------


Route::middleware([ValidMiddleware::class])->group(function () {


    //Home Route Start----------------------------------------------------------------
    Route::controller(HomeController::class)->group(function () {
        Route::get('home', 'home')->name('home');
    });
    //Home Route End----------------------------------------------------------------


    //Supplier Route Start----------------------------------------------------------------
    Route::controller(SupplierController::class)->group(function () {
        Route::get('suppliers', 'suppliers_view')->name('suppliers');
        Route::post('supplier_save', 'supplier_save')->name('supplier_save');
        Route::get('supplier_list', 'supplier_list')->name('supplier_list');
        Route::get('supplier_update_view/{id}', 'supplier_update_view')->name('supplier_update_view');
        Route::post('supplier_update/{id}', 'supplier_update')->name('supplier_update');
        Route::get('supplier_delete/{id}', 'supplier_delete')->name('supplier_delete');
    });
    //Supplier Route End----------------------------------------------------------------


    //Customer Route Start----------------------------------------------------------------
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'customers')->name('customers');
        Route::get('customer_list', 'customer_list')->name('customer_list');
        Route::post('customer_save', 'customer_save')->name('customer_save');
        Route::get('customer_update_view/{id}', 'customer_update_view')->name('customer_update_view');
        Route::post('customer_update/{id}', 'customer_update')->name('customer_update');
        Route::get('customer_delete/{id}', 'customer_delete')->name('customer_delete');
    });
    //Customer Route End----------------------------------------------------------------


    //Product Route Strt----------------------------------------------------------------
    Route::controller(ProductController::class)->group(function () {
        Route::get('product', 'product_view')->name('product_view');
        Route::post('product_save', 'product_save')->name('product_save');
        Route::get('product_update_view/{id}', 'product_update_view')->name('product_update_view');
        Route::post('product_update/{id}', 'product_update')->name('product_update');
        Route::get('product_delete/{id}', 'product_delete')->name('product_delete');
    });
    //Product Route End----------------------------------------------------------------


    // temp_purchse route start
    Route::controller(TempPur_Controller::class)->group(function () {
        Route::get('purchase', 'get_product')->name('purchase');
        Route::post('temp_purchase_save', 'temp_purchase_save')->name('temp_purchase_save');
        Route::get('temp_purchase_delete/{id}', 'temp_purchase_delete')->name('temp_purchase_delete');
        Route::post('temp_purchase_update/{id}', 'temp_purchase_update')->name('temp_purchase_update');
        Route::get('confirm_pruchase', 'confirm_pruchase')->name('confirm_pruchase');
    });
    // temp_purchse route end


    // purchase route start
    Route::controller(PurchaseController::class)->group(function () {
        Route::post('purchase_save', 'purchase_save')->name('purchase_save');
        Route::get('today_purchase', 'today_purchase')->name('today_purchase');
        Route::get('yesterday_purchase', 'yesterday_purchase')->name('yesterday_purchase');
        Route::get('this_month_purchase', 'this_month_purchase')->name('this_month_purchase');
        Route::get('last_month_purchase', 'last_month_purchase')->name('last_month_purchase');
        Route::get('all_purchase', 'all_purchase')->name('all_purchase');
        Route::get('purchase_detail/{id}', 'purchase_detail')->name('purchase_detail');
        Route::get('purchase_delete/{id}', 'purchase_delete')->name('purchase_delete');
        Route::get('purchase_print/{id}', 'purchase_print')->name('purchase_print');
        Route::get('update/{id}', 'update')->name('update');
        Route::post('new_product_update/{id}/{purchase_pk}', 'new_product_update')->name('new_product_update');
        Route::post('update_save/{id}', 'update_save')->name('update_save');
    });
    // purchase route end

    //tempsale route start
    Route::controller(TempSale_Controller::class)->group(function () {
        Route::get('sale', 'sale')->name('sale');
        Route::post('temp_sale_save', 'temp_sale_save')->name('temp_sale_save');
        Route::get('temp_sale_delete/{id}', 'temp_sale_delete')->name('temp_sale_delete');
        Route::post('temp_sale_update/{id}', 'temp_sale_update')->name('temp_sale_update');
        Route::get('confirm_sale', 'confirm_sale')->name('confirm_sale');
    });
    //tempsale route end

    // sale route start
    Route::controller(SaleController::class)->group(function () {
        Route::post('sale_save', 'sale_save')->name('sale_save');
        Route::get('today_sale', 'today_sale')->name('today_sale');
        Route::get('yesterday_sale', 'yesterday_sale')->name('yesterday_sale');
        Route::get('this_month_sale', 'this_month_sale')->name('this_month_sale');
        Route::get('last_month_sale', 'last_month_sale')->name('last_month_sale');
        Route::get('all_sale', 'all_sale')->name('all_sale');
        Route::get('sale_detail/{id}', 'sale_detail')->name('sale_detail');
        Route::get('sale_delete/{id}', 'sale_delete')->name('sale_delete');
        Route::get('sale_print/{id}', 'sale_print')->name('sale_print');
        Route::get('sale_update/{id}', 'sale_update')->name('sale_update');
        Route::get('sale_product_update/{id}/{sale_pk}', 'sale_product_update')->name('sale_product_update');
        Route::post('sale_update_save/{id}', 'sale_update_save')->name('sale_update_save');
    });
    // sale route end


    // stock route start
    Route::controller(StockController::class)->group(function () {
        Route::get('stock', 'stock')->name('stock');
        Route::get('stock_update', 'stock_update')->name('stock_update');
        Route::post('stock_update_save', 'stock_update_save')->name('stock_update_save');
    });
    // stock route end


    // report route start
    Route::controller(ReportController::class)->group(function () {
        Route::get('report', 'report')->name('report');
        Route::get('sale_report', 'sale_report')->name('sale_report');
        Route::post('sale_filter', 'sale_filter')->name('sale_filter');
        Route::get('purchase_report', 'purchase_report')->name('purchase_report');
        Route::post('purchase_filter', 'purchase_filter')->name('purchase_filter');
    });
    // report route end

});
