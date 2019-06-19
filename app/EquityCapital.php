<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquityCapital extends Model
{
    protected $fillable = [
        'amount_paid','final_amount', 'comment', 'processType', 'user_id'
    ];

    public function theSafe(){
        return $this->hasMany(Safe::class);
    }
}
