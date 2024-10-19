<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'price', 'delivery_time', 'restaurant_id', 'offer_id', 'offer_price');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

    function cartItem(){
        return $this->hasMany(Cart::class,'product_id');
    }
    
}
