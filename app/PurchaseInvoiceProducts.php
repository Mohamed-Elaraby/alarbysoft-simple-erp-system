<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoiceProducts extends Model
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

    public function purchaseInvoice ()
    {
        return $this->belongsTo(PurchaseInvoice::class);
    }
}
