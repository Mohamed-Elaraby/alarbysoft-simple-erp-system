<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'purchasing_price', 'dealer_price', 'selling_price', 'quantity', 'serialNumber', 'user_id', 'category_id', 'store_id', 'supplier_id',
    ];

    protected $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier ()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function store ()
    {
        return $this->belongsTo(Store::class);
    }

}
