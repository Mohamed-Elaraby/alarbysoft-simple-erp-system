<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }
}
