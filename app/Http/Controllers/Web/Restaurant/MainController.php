<?php

namespace App\Http\Controllers\Web\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function home(){
        return view('web.restaurant.products.index');
    }

    function getOrders(){
         return view('web.restaurant.orders.index');
    }
}
