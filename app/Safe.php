<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    protected $fillable = [
        'amount_paid','final_amount', 'comment', 'processType', 'user_id', 'payment_id', 'collecting_id', 'order_id'
    ];

    public function clientPayment(){
        return $this->belongsTo(ClientPayment::class);
    }

    public function clientCollecting(){
        return $this->belongsTo(ClientCollecting::class);
    }

    public function saleOrder(){
        return $this->belongsTo(SaleOrder::class);
    }

    public function supplierPayment(){
        return $this->belongsTo(SupplierPayment::class);
    }

    public function supplierCollecting(){
        return $this->belongsTo(SupplierCollecting::class);
    }

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }
}
