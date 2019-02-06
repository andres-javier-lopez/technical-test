<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id');
    }
}
