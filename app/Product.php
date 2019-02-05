<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function likes()
    {
        return $this->belongsToMany('App\User', 'products_users_likes')->withTimestamps();
    }
}
