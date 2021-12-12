<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $products = null;
    public $total_price = 0;
    public $total_quanty = 0;

    public function __construct($cart){
        if($cart){
            $this->products = $cart->products;
            $this->total_price = $cart->total_price;
            $this->total_quanty = $cart->total_quanty;
        }else{
            $products = [];
        }
    }

    public function AddCart($product, $id, $product_id, $size, $color, $price)
    {
        $new_product = ['price_id' => $id , 'id' => $product_id, 'quanty' => 0, 'price' => $price,'product' => $product, 'size' => $size, 'color' => $color];
        if ($this->products)
        {
            if(array_key_exists($id, $this->products)){
                $new_product = $this->products[$id];
            }
        }
        $new_product['quanty']++;
        $new_product['price'] = $new_product['quanty']*$price;

        $this->products[$id] = $new_product;
        $this->total_price += $price;
        $this->total_quanty++;

    }

    public function DeleteItemCart($id)
    {
        $this->total_quanty -= $this->products[$id]['quanty'];
        $this->total_price -= $this->products[$id]['price'];
        unset($this->products[$id]);

    }

    public function UpdateItemCart($id, $quanty, $price){
        $this->total_quanty -= $this->products[$id]['quanty'];
        $this->total_price -=$this->products[$id]['price'];

        $this->products[$id]['quanty'] = $quanty;
        $this->products[$id]['price'] = $quanty * $price;

        $this->total_quanty += $this->products[$id]['quanty'];
        $this->total_price +=$this->products[$id]['price'];

    }

}
