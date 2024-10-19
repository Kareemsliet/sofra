<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'carts';
    public $timestamps = true;
    protected $fillable =array('product_id','description', 'client_id', 'price','quantity');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
