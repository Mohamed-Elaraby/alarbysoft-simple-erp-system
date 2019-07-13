<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recall extends Model
{
    protected $fillable = [
        'name', 'price', 'serial', 'invoiceNo', 'sale_order_id',
    ];
}
