<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'address', 'phones', 'user_id',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }
}
