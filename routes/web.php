<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',[PagesController::class,'index'])->name('home');
Route::get('/viewproduct/{id}',[PagesController::class,'viewproduct'])->name('viewproduct');
Route::get('/categoryproduct/{id}',[PagesController::class,'categoryproduct'])->name('categoryproduct');
Route::get('/search',[PagesController::class,'search'])->name('search');
// contact
Route::get('/contact',[ContactController::class,'index'])->name('contact');

Route::middleware('auth')->group(function(){
Route::post('cart/store',[CartController::class,'store'])->name('cart.store');
Route::get('mycart',[CartController::class,'mycart'])->name('mycart');
Route::get('cart/{id}/destroy',[CartController::class,'destroy'])->name('cart.destroy');
Route::get('checkout/{cartid}',[PagesController::class,'checkout'])->name('checkout');
Route::get('order/{cartid}/store',[OrderController::class,'store'])->name('order.store');

Route::post('order/store',[OrderController::class,'storecod'])->name('order.storecod');

Route::get('myorder',[OrderController::class,'myorder'])->name('myorder');


});


Route::middleware(['auth','admin'])->group(function () {
//category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::delete('/category/destroy',[CategoryController::class,'destroy'])->name('category.destroy');


//product
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::get('/product/destroy/{id}',[ProductController::class,'destroy'])->name('product.destroy');

 //orders
 Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
 Route::get('/orders/{id}/status/{status}',[OrderController::class,'status'])->name('orders.status');
});

//dashboard
Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
