<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// LOGIN PAGE
Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin');



// DASHBOARD
Route::get('dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');



// USER MANAGEMENT
Route::get('user' , [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
Route::post('user_datatable' , [App\Http\Controllers\Admin\UserController::class, 'user_datatable']);
Route::post('store_user' , [App\Http\Controllers\Admin\UserController::class, 'store_user']);
Route::post('edit_user' ,[App\Http\Controllers\Admin\UserController::class, 'edit_user']);
Route::post('delete_user' ,[App\Http\Controllers\Admin\UserController::class, 'delete_user']);
Route::post('restore_user' ,[App\Http\Controllers\Admin\UserController::class, 'restore_user']);



// PRODUCT SETTINGS
Route::get('product', [App\Http\Controllers\Admin\ProductSettingsController::class, 'index'])->name('product');
Route::post('add_brand' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'store_brand']);
Route::post('brand_datatable' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'brand_datatable']);
Route::post('edit_brand' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'edit_brand']);
Route::post('delete_brand' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'delete_brand']);
Route::post('restore_brand' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'restore_brand']);
Route::post('unit_datatable' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'unit_datatable']);
Route::post('add_unit' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'store_unit']);
Route::post('edit_unit' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'edit_unit']);
Route::post('delete_unit' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'delete_unit']);
Route::post('restore_unit' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'restore_unit']);
Route::post('add_category' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'store_category']);
Route::post('edit_category' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'edit_category']);
Route::post('category_datatable' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'category_datatable']);
Route::post('delete_category' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'delete_category']);
Route::post('restore_category' , [App\Http\Controllers\Admin\ProductSettingsController::class, 'restore_category']);


// VENDOR LIST
Route::get('vendor_list' , [App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendor');
Route::post('vendor_datatable' , [App\Http\Controllers\Admin\VendorController::class, 'vendor_datatable']);
Route::post('store_vendor' , [App\Http\Controllers\Admin\VendorController::class, 'store_vendor']);
Route::post('edit_vendor' , [App\Http\Controllers\Admin\VendorController::class, 'edit_vendor']);
Route::post('delete_vendor' , [App\Http\Controllers\Admin\VendorController::class, 'delete_vendor']);
Route::post('restore_vendor' , [App\Http\Controllers\Admin\VendorController::class, 'restore_vendor']);


// PRODUCT LIST
Route::get('product_list' , [App\Http\Controllers\Admin\ProductUnitController::class, 'index'])->name('product_list');
Route::post('product_datatable' , [App\Http\Controllers\Admin\ProductUnitController::class, 'product_datatable']);
Route::post('store_product' , [App\Http\Controllers\Admin\ProductUnitController::class, 'store_product']);
Route::post('edit_product' , [App\Http\Controllers\Admin\ProductUnitController::class, 'edit_product']);
Route::post('delete_product' , [App\Http\Controllers\Admin\ProductUnitController::class, 'delete_product']);
Route::post('restore_product' , [App\Http\Controllers\Admin\ProductUnitController::class, 'restore_product']);

// PURCHASE ORDER
Route::get('purchase_order' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'index'])->name('purchase_order');
Route::post('get-product-info' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'get_product_info']);
Route::post('pass_data' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'pass_data']);
Route::post('add_purchase' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'store_purchase']);
Route::post('purchase_datatable' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'purchase_datatable']);
Route::post('search' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'search']);
Route::get('purchase_order_edit/{id}' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'purchase_order_edit']);
Route::post('update_purchase' , [App\Http\Controllers\Admin\PurchaseOrderController::class, 'update_purchase']);
