<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;
use Session;
class CartController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        return view ('guest.pages.index', compact('products', 'categories'));
    }

    public function demo()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        return view ('guest.pages.list_cart', compact('products'));

    }

    public function add_cart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product != null)
        {
            $old_cart = Session('cart') ? Session('cart'):null;
            $new_cart = new Cart($old_cart);
            $new_cart->AddCart($product, $request->id, $id, $request->size, $request->color, $request->price);
            $request->session()->put('cart', $new_cart);
        }
//        dd(Session('cart'));
        return redirect()->route('guest.detail', ['id' => $product->id]);

    }

    public function show_cart()
    {
        $categories = ProductCategory::all();
        $images = Image::all();
        return view ('guest.pages.list_cart', compact('images', 'categories'));
    }

    public function delete_cart(Request $request, $id)
    {
//        dd($id);
        $old_cart = Session('cart') ? Session('cart'): null;
        $new_cart = new Cart($old_cart);
        $new_cart->DeleteItemCart($id);
        if(Count($new_cart->products) > 0)
        {
            $request->Session()->put('cart', $new_cart);
        }
        else{
            $request->Session()->forget('cart');
        }
        redirect()->route('guest.show_cart');
    }

    public function update_cart(Request $request, $id){
//        $categories=Category::all();
        $old_cart= session('cart') ? session('cart') :null;
        $new_cart= new Cart($old_cart);
        $new_cart->UpdateItemCart($id,$request->number,$request->price);
//        dd($request->number);

        $request->session()->put('cart',$new_cart);

        redirect()->route('guest.show_cart');
    }

    public function order()
    {
        $categories = ProductCategory::all();
        return view('guest.pages.order', compact('categories'));
    }

}
