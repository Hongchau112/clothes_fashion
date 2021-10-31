<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        $products = Product::paginate(8);
        $categories = ProductCategory::all();
        return view('guest.pages.index', compact('images','products', 'categories', 'products'));

    }

    public function show()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        $images = Image::all();
        return view('guest.pages.show', compact('products', 'categories', 'images'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::all();
        $product_price = ProductPrice::all();
        $images = Image::where('product_id', $id)->get();
        return view('guest.pages.detail', compact('product','categories', 'product_price', 'images'));
    }

    public function get_price(Request $request)
    {
        $id=$request->get('id');
        $product = Product::find($id);
        foreach($product->color as $color){
            if($color->name == $request->color)
//                dd($color->product_price->price);
                echo $color->product_prices->price ;

        }
    }

    public function get_price_id(Request $request)
    {
        $id=$request->get('id');
        $product = Product::find($id);
        foreach($product->color as $color){
            if($color->name == $request->color)
//                dd($color->product_price->price_id);
                echo $color->product_prices->price_id;

        }
    }

    public function checkout()
    {
        $categories = ProductCategory::all();
        return view('guest.pages.order', compact('categories'));
    }

    public function search(Request $request)
    {
        $key_search = $request->get('key_search');
        $categories = ProductCategory::all();
        $images = Image::all();

        $products = Product::select('products.*')
            ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
            ->where('product_types.name','like','%'.$key_search.'%')->orWhere('products.name','like','%'.$key_search.'%')
            ->paginate(12);
        $products->appends(['$key_search' => $key_search]);
        return view('guest.pages.index',compact('products','categories', 'images'));
    }






}
