<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'comment', 'payment_date', 'user_id', 'store_id', 'client_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function store ()
    {
        return $this->belongsTo(Store::class);
    }

    public function client ()
    {
        return $this->belongsTo(Client::class);
    }
}
