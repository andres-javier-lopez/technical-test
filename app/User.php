<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function purchases()
    {
        return $this->hasMany('App\Purchases', 'buyer_id');
    }

    public function likedProducts()
    {
        return $this->belongsToMany('App\Product', 'products_users_likes')->withTimestamps();
    }

    public function like(Product $product)
    {
        $this->likedProducts()->syncWithoutDetaching([$product->id]);
    }

    public function unlike(Product $product)
    {
        $this->likedProducts()->detach($product->id);
    }
}
