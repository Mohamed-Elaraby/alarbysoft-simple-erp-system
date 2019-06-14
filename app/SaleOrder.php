<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
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

    public function saleOrderProducts ()
    {
        return $this->hasMany(SaleOrderProducts::class);
    }

    public function products ()
    {
        return $this->hasMany(Product::class);
    }

    public function clientTransaction ()
    {
        return $this->hasMany(ClientTransaction::class);
    }

    public function theSafe(){
        return $this->hasMany(Safe::class);
    }

}
