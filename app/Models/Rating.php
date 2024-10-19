<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model 
{

    protected $table = 'ratings';
    public $timestamps = true;
    protected $fillable = array('client_id', 'rate', 'comment', 'restaurant_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}