<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/home', function () {
    return redirect()->route('products.index');
});

Auth::routes();



Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    // 'middleware' => 'admin'
], function(){

    // Route::get('/', );

    Route::resource('users', UserController::class);
    Route::get('users/{user}/delete',[UserController::class, 'destroy'])->name('users.delete');
    

});

// Route::get('/profile/{user}', [UserController::class, 'userProfile'])->name('profile');
Route::get('/profile/{user}', [UserController::class, 'userProfile'])->name('users.profile');

Route::get('/products/search/{search}', [ProductController::class, 'search']);
Route::resource('/products', ProductController::class);
Route::get('/my_products', [ProductController::class, 'myProducts'])->name('products.my');
Route::get('/products/{product}/order', [OrderController::class, 'order'])->name('products.order');
Route::get('/products/{product}/order/success', [OrderController::class, 'orderExchange'])->name('products.order.exchange');

Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

// Route::get('/products/search/{search}', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/{product}/payment', [PaymentController::class, 'payment'])->name('products.payment');
Route::get('/products/{product}/payment/success', [PaymentController::class, 'success'])->name('products.payment.success');
Route::get('/products/{product}/payment/failed', [PaymentController::class, 'failed'])->name('products.payment.failed');
// Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');

