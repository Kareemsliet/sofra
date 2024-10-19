<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;

    protected $fillable = array('description','payment_method_id','client_id', 'total', 'commission', 'statue', 'restaurant_id','delivery_cost','cost','net');

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function products()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
