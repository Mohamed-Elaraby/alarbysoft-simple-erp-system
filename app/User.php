<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickName', 'email', 'password', 'salary', 'birthDate', 'admin', 'moderator', 'seller'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function phone ()
    {
        return $this->hasOne(Phone::class);
    }

    public function address ()
    {
        return $this->hasOne(Address::class);
    }

    public function media ()
    {
        return $this->hasOne(Media::class);
    }

    public function categories ()
    {
        return $this->hasMany(Category::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }

    public function stores ()
    {
        return $this->hasMany(Store::class);
    }

    public function suppliers ()
    {
        return $this->hasMany(Supplier::class);
    }

    public function purchases ()
    {
        return $this->hasMany(Purchases::class);
    }

    public function sales ()
    {
        return $this->hasMany(Sales::class);
    }

    public function expenses ()
    {
        return $this->hasMany(Expenses::class);
    }
}
