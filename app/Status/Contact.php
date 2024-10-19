<?php

namespace App\Status;

enum Contact: int
{
    case replay=0;  // استعلام

    case complaint=1; // شكوي

    case suggestion=2; // اقتراح

    function name(){
        return match($this){
            Contact::replay=>"استعلام",

            Contact::complaint=>"شكوي",

            Contact::suggestion=>"اقتراح"
        };
    }
}




