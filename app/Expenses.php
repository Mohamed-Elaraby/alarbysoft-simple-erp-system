<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'price', 'comment', 'user_id', 'store_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
