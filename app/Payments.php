<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'price', 'comment', 'type', 'payment_date', 'user_id', 'store_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
