<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'comment', 'expenses_date', 'user_id', 'store_id', 'expenses_type_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function expensesType ()
    {
        return $this->belongsTo(ExpensesType::class);
    }
}
