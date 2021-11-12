<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
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

Route::get('admin/login', function(){
    return view('admin.users.login');
});

Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->name('admin.')->group(function () {
    //admins
    Route::get('admin/', [AdminController::class, 'index'])->name('index');
    Route::get('admin/create', [AdminController::class, 'create'])->name('create');
    Route::post('admin/store', [AdminController::class, 'store'])->name('store');
    Route::get('admin/show/{id}', [AdminController::class, 'show'])->name('show');
    Route::get('admin/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::patch('admin/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('admin/block/{id}', [AdminController::class, 'block'])->name('block');
    Route::get('admin/edit_password/{id}', [AdminController::class, 'edit_password'])->name('edit_password');
    Route::post('admin/change_password/{id}', [AdminController::class, 'change_password'])->name('change_password');

    //product categories
    Route::get('admin/product_categories', [ProductCategoryController::class, 'index'])->name('product_categories.index');
    Route::get('admin/product_categories/create', [ProductCategoryController::class, 'create'])->name('product_categories.create');
    Route::post('admin/product_categories/store', [ProductCategoryController::class, 'store'])->name('product_categories.store');
    Route::get('admin/product_categories/edit/{id}', [ProductCategoryController::class, 'edit'])->name('product_categories.edit');
    Route::patch('admin/product_categories/update/{id}', [ProductCategoryController::class, 'update'])->name('product_categories.update');
    Route::get('admin/product_categories/delete/{id}', [ProductCategoryController::class, 'delete'])->name('product_categories.delete');

     //product
    Route::get('admin/products/', [ProductController::class, 'index'])->name('products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('admin/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('admin/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('admin/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('admin/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('admin/products/edit_price/{id}', [ProductController::class, 'edit_price'])->name('products.edit_price');
    Route::post('admin/products/update_price/{id}', [ProductController::class, 'update_price'])->name('products.update_price');
    Route::get('admin/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
//transaction
    Route::post('admin/check_mail', [AdminController::class,'check_mail'])->name('check_mail');
    Route::get('admin/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('admin/success', [TransactionController::class,'success'])->name('transaction.success');
    Route::get('admin/transaction/show/{id}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::get('admin/transaction/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::post('admin/transaction/update_status/{id}', [TransactionController::class, 'update_status'])->name('transaction.update_status');
});

Route::get('guest/index', [PageController::class, 'index'])->name('guest.index');
Route::get('guest/show', [PageController::class, 'show'])->name('guest.show');
Route::get('guest/detail/{id}', [PageController::class, 'detail'])->name('guest.detail');
Route::post('guest/get_price', [PageController::class, 'get_price'])->name('guest.get_price');
Route::get('guest/search', [PageController::class, 'search'])->name('guest.search');

Route::get('guest/add_cart/{id}', [CartController::class, 'add_cart'])->name('guest.add_cart');
Route::get('guest/demo', [CartController::class, 'demo'])->name('guest.demo');
Route::post('guest/get_price_id', [PageController::class, 'get_price_id'])->name('guest.get_price_id');
Route::get('guest/show_cart', [CartController::class, 'show_cart'])->name('guest.show_cart');
Route::get('guest/delete_cart/{id}', [CartController::class, 'delete_cart'])->name('guest.delete_cart');
Route::get('guest/update_cart/{id}', [CartController::class,'update_cart'])->name('guest.update_cart');



Route::get('guest/order', [CartController::class,'order'])->name('guest.order');

Route::get('guest/checkout', [PageController::class,'checkout'])->name('guest.checkout');
Route::get('guest/success', [TransactionController::class,'success'])->name('guest.success');
Route::post('guest/checkout/store', [TransactionController::class, 'store'])->name('guest.transaction.store');
//Route::middleware(['guest'])->name('guest.')->group(function () {
//    Route::get('guest/index', [PageController::class, 'index'])->name('index');
//});



