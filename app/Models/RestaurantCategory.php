<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model 
{

    protected $table = 'restaurant_categories';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'category_id');

}