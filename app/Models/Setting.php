<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'setting';
    public $timestamps = true;
    protected $fillable = array('name', 'logo', 'hero_image', 'description','commission');

}
