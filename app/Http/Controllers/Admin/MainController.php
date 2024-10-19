<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class MainController extends Controller
{
    function home(){
        
        $sections=sections();

       

        return view('admin.index',compact('sections'));
    }
}
