<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['product', 'price', 'quantity', 'discount', 'total', 'user_id', 'store_id'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
