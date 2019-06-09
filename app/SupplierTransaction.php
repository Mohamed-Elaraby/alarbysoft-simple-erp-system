<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierTransaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'transaction_date', 'user_id', 'supplier_id', 'purchase_order_id', 'supplier_payment_id', 'supplier_collecting_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrder ()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function supplierPayment ()
    {
        return $this->belongsTo(SupplierPayment::class);
    }

    public function supplierCollecting ()
    {
        return $this->belongsTo(SupplierCollecting::class);
    }
}
