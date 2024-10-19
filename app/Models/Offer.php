<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('discount','name', 'description', 'image', 'from', 'to', 'restaurant_id');

    function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

}
