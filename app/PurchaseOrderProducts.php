<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderProducts extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'price', 'quantity', 'total', 'purchase_order_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseOrder ()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
