<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestauranConection extends Model 
{

    protected $table = 'restaurants_conections';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'phone', 'whatsapp');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}