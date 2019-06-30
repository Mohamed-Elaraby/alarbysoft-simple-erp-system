<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrderProducts extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'purchase_price', 'price', 'quantity', 'total', 'total_purchase_price', 'serial', 'invoiceNo'
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
