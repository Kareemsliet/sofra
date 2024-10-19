<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    public $timestamps = true;
    protected $fillable = array('order_id', 'name','description', 'price', 'quantity');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
