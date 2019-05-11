<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function store ()
    {
        return $this->belongsTo(Store::class);
    }

}
