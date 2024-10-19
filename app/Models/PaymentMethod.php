<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model 
{

    protected $table = 'payments_methods';
    public $timestamps = true;
    protected $fillable = array('name', 'description');

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

}