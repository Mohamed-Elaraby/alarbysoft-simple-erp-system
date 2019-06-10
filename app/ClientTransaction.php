<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientTransaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'transaction_date', 'user_id', 'client_id', 'sale_order_id', 'payment_id', 'collecting_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function client ()
    {
        return $this->belongsTo(Client::class);
    }

    public function saleOrder ()
    {
        return $this->belongsTo(SaleOrder::class);
    }

    public function clientPayment ()
    {
        return $this->belongsTo(ClientPayment::class);
    }

    public function clientCollecting ()
    {
        return $this->belongsTo(ClientCollecting::class);
    }
}
