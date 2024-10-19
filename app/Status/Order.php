<?php

namespace App\Status;

enum Order: int
{
    case PENDING=0;  // انتظار
    case ACCEPT=1;   // موافق
    case REJECT=2;   // مرفوض

    case DELIVERIED=3;   // تاكيد استلام

    case DECLINE=4;    // مرفوض

    function name(){
        return match($this){
            self::ACCEPT=>"مقبول",

            self::REJECT=>"مرفوض",

            self::PENDING=>"في حالة انتظار",


            self::DELIVERIED=>"تم تاكيد الاستلام",


            self::DECLINE=>"مرفوض للسبب",


        };
    }
}
