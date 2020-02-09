<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'purchase_price', 'dealer_price', 'selling_price', 'quantity', 'user_id', 'category_id', 'store_id', 'supplier_id',
    ];

    protected $dates = ['deleted_at'];

//    protected $appends = ['profit_percent'];

//    public function getProfitPercentAttribute()
//    {
//        $sumQ = $this->quantity - $this->purchasing_price;
//        $total =
//
//        return number_format($profit_percent,2);
//    }

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

    public function purchaseInvoice ()
    {
        return $this->belongsTo(PurchaseInvoice::class);
    }

    public function serials ()
    {
        return $this->hasMany(Serial::class);
    }

}
