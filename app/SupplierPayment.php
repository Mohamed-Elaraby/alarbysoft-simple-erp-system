<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierPayment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'comment', 'payment_date', 'user_id', 'store_id', 'supplier_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function store ()
    {
        return $this->belongsTo(Store::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplierTransactions ()
    {
        return $this->hasMany(SupplierTransaction::class);
    }
}
