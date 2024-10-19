<?php

use App\Http\Controllers\Web\Auth\Client\ClientMainController;
use App\Http\Controllers\Web\Auth\Client\ClientPasswordController;
use App\Http\Controllers\Web\Auth\Restaurant\RestaurantMainController;
use App\Http\Controllers\Web\Auth\Restaurant\RestaurantPasswordController;
use App\Http\Controllers\Web\Restaurant\MainController;
use App\Http\Controllers\Web\Restaurant\OffersController;
use App\Http\Controllers\Web\Restaurant\ProductsController;
use Illuminate\Support\Facades\Route;


    Route::group(['middleware'=>"guest:client",'prefix'=>"auth"],function(){
        Route::post('/login',[ClientMainController::class,'login'])->name('client.login');
        Route::post('/register',[ClientMainController::class,'register'])->name('client.register');
        Route::get('/login',[ClientMainController::class,'showLoginForm'])->name('client.showLoginForm');
        Route::get('/register',[ClientMainController::class,'showRegisterForm'])->name('client.showRegisterForm');
        Route::get('/password/forget',[ClientPasswordController::class,'forget'])->name('client.password.forget');
        Route::get('/password/reset/{token}',[ClientPasswordController::class,'reset'])->name('client.password.reset');
        Route::post('/password/update',[ClientPasswordController::class,'update'])->name('client.password.update');
        Route::post('/password/email',[ClientPasswordController::class,'checkEmail'])->name('client.password.email');
    });

    Route::group(['middleware'=>"auth:client"],function(){
        Route::post('/logout',[ClientMainController::class,'logout'])->name('client.logout');
        Route::get('/carts',[\App\Http\Controllers\Web\Client\MainController::class,'getCartItems'])->name('carts');
        Route::get('/order/{restaurant_id}/add',[\App\Http\Controllers\Web\Client\MainController::class,'createOrder'])->name('order.create');
        Route::post('/order/{restaurant_id}/add',[\App\Http\Controllers\Web\Client\MainController::class,'addOrder'])->name('order.add');
        Route::get('/orders',[\App\Http\Controllers\Web\Client\MainController::class,'getOrders'])->name('orders');
    });

    Route::get('/',[\App\Http\Controllers\Web\MainController::class,'home'])->name('index');
    Route::get('/restaurants/{id}',[\App\Http\Controllers\Web\MainController::class,'getRestaurant'])->name('restaurant');
    Route::get('/products/{id}',[\App\Http\Controllers\Web\MainController::class,'getProduct'])->name('product');
    Route::get('/contact-us',[\App\Http\Controllers\Web\MainController::class,'contactPage'])->name('contact');
    Route::post('/contact-us',[\App\Http\Controllers\Web\MainController::class,'addContact'])->name('contact.add');

    Route::group(['prefix'=>"restaurant"],function(){
        Route::group(['middleware'=>"guest:restaurant",'prefix'=>"auth"],function(){
        Route::post('/login',[RestaurantMainController::class,'login'])->name('restaurant.login');
        Route::post('/register',[RestaurantMainController::class,'register'])->name('restaurant.register');
        Route::get('/login',[RestaurantMainController::class,'showLoginForm'])->name('restaurant.showLoginForm');
        Route::get('/register',[RestaurantMainController::class,'showRegisterForm'])->name('restaurant.showRegisterForm');
        Route::get('/password/forget',[RestaurantPasswordController::class,'forget'])->name('restaurant.password.forget');
        Route::get('/password/reset/{token}',[RestaurantPasswordController::class,'reset'])->name('restaurant.password.reset');
        Route::post('/password/update',[RestaurantPasswordController::class,'update'])->name('restaurant.password.update');
        Route::post('/password/email',[RestaurantPasswordController::class,'checkEmail'])->name('restaurant.password.email');
    });

    Route::group(['middleware'=>"auth:restaurant"],function(){
        Route::get('/',[MainController::class,'home'])->name('restaurant.index');
        Route::post('/logout',[RestaurantMainController::class,'logout'])->name('restaurant.logout');
        Route::resource('/product',ProductsController::class)->except(['show','destroy']);
        Route::resource('/offer',OffersController::class)->except(['show','destroy']);
        Route::get('/orders',[MainController::class,'getOrders'])->name('restaurant.orders');
    });

});

require_once __DIR__.'/admin.php';
