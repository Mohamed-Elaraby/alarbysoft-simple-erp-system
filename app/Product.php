<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'purchase_price', 'dealer_price', 'selling_price', 'quantity', 'user_id', 'category_id', 'invoice_id',
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['profit_percent'];

    public function getProfitPercentAttribute()
    {
        $profit = $this->selling_price - $this->purchasing_price;
        $profit_percent = $profit * 100 / $this->purchasing_price;

        return number_format($profit_percent,2);
    }

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

}
