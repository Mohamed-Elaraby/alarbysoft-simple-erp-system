<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
