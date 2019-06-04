<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrderProducts extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'price', 'quantity', 'total',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function saleOrder ()
    {
        return $this->belongsTo(SaleOrder::class);
    }
}
