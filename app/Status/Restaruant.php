<?php

namespace App\Status;

enum Restaruant: int
{
    case CLOSE=0; 
    
    case OPEN=1;

    
    function name(){
        return match($this){
            Restaruant::CLOSE=>"مغلق",

            Restaruant::OPEN=>"مفتوح",
        };
    }
}


