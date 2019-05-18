<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'balance', 'phones', 'user_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
