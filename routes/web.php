<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Trang nguoi dung*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Routes Trong Trang admin*/
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

//  Category Routes
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);

//  Theme Routes
    Route::get('add-theme', [App\Http\Controllers\Admin\ThemeController::class, 'index'])->name('theme');
    Route::post('add-theme', [App\Http\Controllers\Admin\ThemeController::class, 'store']);
    Route::put('update-theme/{theme_id}', [App\Http\Controllers\Admin\ThemeController::class, 'update']);
    Route::get('delete-theme/{theme_id}', [App\Http\Controllers\Admin\ThemeController::class, 'delete']);

//  Lego Piece Routes
    Route::get('lego_piece', [App\Http\Controllers\Admin\PieceController::class, 'index'])->name('piece');
    Route::get('add-piece', [App\Http\Controllers\Admin\PieceController::class, 'create']);
    Route::post('add-piece', [App\Http\Controllers\Admin\PieceController::class, 'store']);
    Route::get('edit-piece/{piece_id}', [App\Http\Controllers\Admin\PieceController::class, 'edit']);
    Route::put('update-piece/{piece_id}', [App\Http\Controllers\Admin\PieceController::class, 'update']);

//  Shape Routes
    Route::get('add-shape', [App\Http\Controllers\Admin\ShapeController::class, 'index'])->name('shape');
    Route::post('add-shape', [App\Http\Controllers\Admin\ShapeController::class, 'store']);
    Route::put('update-shape/{shape_id}', [App\Http\Controllers\Admin\ShapeController::class, 'update']);
    Route::get('delete-shape/{shape_id}', [App\Http\Controllers\Admin\ShapeController::class, 'delete']);

//  Color Routes
    Route::get('add-color', [App\Http\Controllers\Admin\ColorController::class, 'index'])->name('color');
    Route::post('add-color', [App\Http\Controllers\Admin\ColorController::class, 'store']);
    Route::put('update-color/{color_id}', [App\Http\Controllers\Admin\ColorController::class, 'update']);
    Route::get('delete-color/{color_id}', [App\Http\Controllers\Admin\ColorController::class, 'delete']);

//  Size Routes
    Route::get('add-size', [App\Http\Controllers\Admin\SizeController::class, 'index'])->name('size');
    Route::post('add-size', [App\Http\Controllers\Admin\SizeController::class, 'store']);
    Route::put('update-size/{size_id}', [App\Http\Controllers\Admin\SizeController::class, 'update']);
    Route::get('delete-size/{size_id}', [App\Http\Controllers\Admin\SizeController::class, 'delete']);

//  Product Routes
    Route::get('product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product');
    Route::get('add-product', [App\Http\Controllers\Admin\ProductController::class, 'create']);
    Route::post('add-product', [App\Http\Controllers\Admin\ProductController::class, 'create_step_2']);
    Route::post('add-product-step2', [App\Http\Controllers\Admin\ProductController::class, 'store']);
    Route::get('edit-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product-edit');
    Route::post('edit-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('update-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('delete-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);

//  Employee Routes
    Route::get('employee', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employee');
    Route::get('add-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'create']);
    Route::post('add-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'store']);
    Route::get('edit-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit']);
    Route::put('edit-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update']);
    Route::get('delete-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'delete']);

//  Customer Routes
    Route::get('customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer');
    Route::get('edit-customer/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'edit']);


});
