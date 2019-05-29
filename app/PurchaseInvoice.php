<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'invoiceNo', 'invoiceDate', 'notes', 'invoice_subtotal', 'tax_percent', 'tax', 'invoice_total', 'payment_method', 'amount_paid', 'amount_due', 'user_id', 'store_id', 'supplier_id',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseInvoiceProducts ()
    {
        return $this->hasMany(PurchaseInvoiceProducts::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }

}
