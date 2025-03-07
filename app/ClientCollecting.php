<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCollecting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'amount', 'comment', 'collect_date', 'user_id', 'store_id', 'client_id'
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

    public function clientTransaction ()
    {
        return $this->hasMany(ClientTransaction::class);
    }

    public function theSafe(){
        return $this->hasMany(Safe::class);
    }
}
