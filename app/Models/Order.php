<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable =[
        'name',
        'address',
        'phone_number',
        'total',
        'status',
    ];
    public function orders()
    {
        return $this->belongsToMany('App\Models\ProductPrice','order_detail',
            'order_id','product_price')->withPivot('number', 'id')->withTimestamps()->as('order_detail');
    }

//    public function products()
//    {
//        return $this->belongsToMany('App\Models\Product','product_prices','price_id','product_id')->withPivot('product_id', 'price_id')->as('prices');
//    }

//    public function exam()
//    {
//        return $this->belongsTo(ProductPrice::class, 'product_price_id', 'price');
//    }
}
