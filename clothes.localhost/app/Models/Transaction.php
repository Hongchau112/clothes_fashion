<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $table = 'transactions';
    protected $fillable =[
        'name',
        'address',
        'phone_number',
        'total',
        'status',
    ];
    public function orders()
    {
        return $this->belongsToMany('App\Models\ProductPrice','order_items',
            'trans_id','product_price_id')->withPivot('number', 'id')->withTimestamps()->as('order_items');
    }

}
