<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function likedProducts()
    {
        $this->belongsToMany('App\Product', 'products_users_likes')->withTimestamps();
    }

    public function like(App\Product $product)
    {
        $this->likedProducts()->attach($product->id);
    }

    public function unlike(App\Product $product)
    {
        $this->likedProducts()->detach($product->id);
    }
}
