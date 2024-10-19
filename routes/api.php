<?php

use App\Http\Controllers\Api\CartItemsController;
use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\OffersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\RestaurantAuthController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>"v1"],function(){

    Route::group(['prefix'=>"/client"],function(){
      Route::post('/login',[ClientAuthController::class,'login']);
      Route::post('/register',[ClientAuthController::class,'register']);
      Route::post('/password/reset',[ClientAuthController::class,'resetPassword']);

      Route::group(['middleware'=>"auth:sanctum"],function(){
        Route::post('/logout',[ClientAuthController::class,'logout']);
         Route::post('/rating/add',[ClientController::class,'addRate']);
         Route::apiResource('/carts',CartItemsController::class)->except('show');
         Route::post('/order/add',[ClientController::class,'addOrder']);
         Route::get('/notifications',action: [ClientController::class,'getNotifications']);
         Route::get('/orders/new',[ClientController::class,'getNewOrders']);
         Route::get('/orders/old',[ClientController::class,'getOldOrders']);
         Route::post('order/{id}/reject',[ClientController::class,'rejectOrder']);
         Route::post('order/{id}/delivery',[ClientController::class,'deliveryOrder']);
        });
        
    });

    Route::post('/contact',[MainController::class,'addContact']);
    Route::get('/categories',[MainController::class,'getCategories']);
    Route::get('/regions',[MainController::class,'getRegions']);
    Route::get('/cities',[MainController::class,'getCities']);
    Route::get('/regions/{city_id}',[MainController::class,'getRegionsByCity']);
    Route::get('/payments-methods',[MainController::class,'getPaymentMethods']);
    Route::get('/restaurants',[MainController::class,'getRestaurants']);
    Route::get('/setting',[MainController::class,'setting']);
    Route::get('/restaurants/{id}/products',[MainController::class,'getRestaurantProducts']);
    Route::get('/restaurants/{id}/ratings',[MainController::class,'getRestaurantRatings']);
    Route::get('/restaurants/{id}/info',[MainController::class,'getRestaurant']);
    Route::get('/product/{id}/info',[MainController::class,'getProduct']);
    Route::get('/restaurants/{id}/offers',[MainController::class,'getRestaurantOffers']);

    Route::group(['prefix'=>"/restaurant"],function(){
        Route::post('/login',[RestaurantAuthController::class,'login']);
        Route::post('/register',[RestaurantAuthController::class,'register']);
        Route::post('/password/reset',[RestaurantAuthController::class,'resetPassword']);


         Route::group(['middleware'=>"auth:sanctum"],function(){
          Route::post('/logout',[RestaurantAuthController::class,'logout']);
          Route::apiResource('/products',ProductsController::class);
          Route::apiResource('/offers',OffersController::class);
          Route::get('/notifications',action: [RestaurantController::class,'getNotifications']);
          Route::get('/orders/available',[RestaurantController::class,'getAvailableOrders']);
          Route::get('/orders/new',[RestaurantController::class,'getNewOrders']);
          Route::get('/orders/old',[RestaurantController::class,'getOldOrders']);
          Route::post('order/{id}/reject',[RestaurantController::class,'rejectOrder']);
          Route::post('order/{id}/delivery',[RestaurantController::class,'deliveryOrder']);
          Route::post('order/{id}/accept',[RestaurantController::class,'acceptOrder']);
          Route::get('/info',[RestaurantController::class,"getInfo"]);
        });


    });

});

