<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'invoiceNo', 'invoiceDate', 'notes', 'invoice_subtotal', 'tax_percent', 'tax', 'invoice_total', 'payment_method', 'amount_paid', 'amount_due', 'user_id', 'store_id', 'client_id',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function client ()
    {
        return $this->belongsTo(Client::class);
    }

    public function purchaseOrderProducts ()
    {
        return $this->hasMany(PurchaseOrderProducts::class);
    }

    public function serials ()
    {
        return $this->hasMany(Serial::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }

    public function clientTransactions ()
    {
        return $this->hasMany(ClientTransaction::class);
    }

    public function theSafe ()
    {
        return $this->hasMany(Safe::class);
    }

}
