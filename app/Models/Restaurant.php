<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable{

    use HasApiTokens,Notifiable,CanResetPassword;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'region_id', 'minimum_order', 'delivery_price', 'statue', 'image');
    protected $hidden = array('password');

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'restaurant_categories');
    }

    public function conections()
    {
        return $this->hasMany('App\Models\RestauranConection');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function sendPasswordResetNotification($token): void
    {
        $url ="http://sofra.test/restaurant/auth/password/reset/".$token."?email=".$this->email;

        $this->notify(new ResetPasswordNotification($url));
    }
}
