<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'password', 'password_text', 'email', 'balance', 'phones', 'client_type', 'user_id'
    ];

    protected $guarded = ['client'];

    protected $hidden = [
        'password', 'remember_token',
    ];
//    public function getAuthPassword()
//    {
//        return $this->password; // returned hashed password
//    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function phone ()
    {
        return $this->hasOne(Phone::class);
    }

    protected function SaleOrders()
    {
        return $this->hasMany(SaleOrder::class);
    }

    protected function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function transactions ()
    {
        return $this->hasMany(ClientTransaction::class);
    }
}
