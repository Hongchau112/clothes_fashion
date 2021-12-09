<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'id',
        'number',
        'product_price_id',
        'trans_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_prices','price_id','product_id')->withPivot('product_id', 'price_id')->as('prices');
    }

//    public function exam()
//    {
//        return $this->belongsTo(ProductPrice::class, 'product_price_id', 'price');
//    }
}
