<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    protected $fillable = [
        'amount_paid','final_amount', 'comment', 'processType', 'user_id', 'client_payment_id', 'client_collecting_id', 'sale_order_id', 'supplier_payment_id', 'supplier_collecting_id', 'purchase_order_id'
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

    public function equityCapital(){
        return $this->belongsTo(EquityCapital::class);
    }
}
