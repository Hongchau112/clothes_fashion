<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
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
    return view('admin.login');
});

//Route::post('admin/login', function(){
//    return view('admin.login');
//});

Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    //admins
    Route::get('admin/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('admin/block/{id}', [AdminController::class, 'block'])->name('admin.block');

    //product categories
    Route::get('/product_categories', [ProductCategoryController::class, 'index'])->name('product_categories.index');
    Route::get('/product_categories/create', [ProductCategoryController::class, 'create'])->name('product_categories.create');
    Route::post('/product_categories/store', [ProductCategoryController::class, 'store'])->name('product_categories.store');
    Route::get('/product_categories/edit/{id}', [ProductCategoryController::class, 'edit'])->name('product_categories.edit');
    Route::patch('/product_categories/update/{id}', [ProductCategoryController::class, 'update'])->name('product_categories.update');
    Route::get('/product_categories/delete/{id}', [ProductCategoryController::class, 'delete'])->name('product_categories.delete');


});



