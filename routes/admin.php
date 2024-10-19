<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\RegionsController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;

Route::group(['prefix'=>"admin-panel"],function(){

    Route::get('/login',[AuthController::class,'showLoginForm'])->name('admin.loginForm')->middleware('guest');
    Route::post('/login',[AuthController::class,'login'])->name('admin.login')->middleware('guest');
    Route::post('/logout',[AuthController::class,'logout'])->name('admin.logout')->middleware('auth');

    Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('admin.password.forget');
    Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('admin.password.reset');

    Route::group(['middleware'=>['auth','auto-permission']],function(){
    Route::resource('/categories',CategoriesController::class)->except('show');
    Route::resource('/cities',CitiesController::class)->except('show');
    Route::resource('/regions',RegionsController::class)->except('show');
    Route::resource('/payment-methods',PaymentMethodsController::class)->except('show');
    Route::resource('/payments',PaymentsController::class)->except('show');
    Route::resource('/setting',SettingController::class)->except(['edit','create','show']);
    Route::resource('/users',UsersController::class)->except(['show']);
    Route::get('/',[MainController::class,'home'])->name('admin.index');
    Route::resource('/roles',RolesController::class)->except(['show']);
    Route::resource('/clients',ClientController::class)->only(['index','destroy']);
    Route::resource('/restaurants',RestaurantController::class)->only(['index','destroy']);
    Route::resource('/contacts',ContactController::class)->only(['index','destroy']);
    Route::resource('/orders',OrdersController::class)->only(['index','destroy']);
    Route::get('contacts/{id}/reply',[ContactController::class,'showReplyForm'])->name('contacts.replyForm');
    Route::post('contacts/{id}/reply',[ContactController::class,'reply'])->name('contacts.reply');
});
});

