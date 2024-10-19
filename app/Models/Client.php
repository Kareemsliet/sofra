<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Client extends Authenticatable
{
    use HasApiTokens,Notifiable,CanResetPassword;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'email', 'password', 'region_id');
    protected $hidden = array('password');

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function cartItems()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function sendPasswordResetNotification($token): void
{
    $url ="http://sofra.test/auth/password/reset/".$token."?email=".$this->email;

    $this->notify(new ResetPasswordNotification($url));
}

}
