<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = [
        'id',
        'number',
        'product_id',
        'product_name',
        'order_id',
        'product_price',
        'size',
        'color'
    ];
}
