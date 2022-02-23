<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'seller_id',
        'short_desc',
        'long_desc',
        'category',
        'title',
        'creation_time',
        'normal_timer',
        'quick_timer',
        'current_bid',
        'increment',
        'is_going_once',
        'is_going_twice',
        'sold_timer',
        'is_sold',
        'del_timer'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'seller_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'product_id', 'product_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'product_id', 'product_id');
    }

    public function payment_intent()
    {
        return $this->hasOne(PaymentIntent::class, 'product_id', 'product_id');
    }

    public function winner()
    {
        return $this->hasOne(Winner::class, 'product_id', 'product_id');
    }
}
