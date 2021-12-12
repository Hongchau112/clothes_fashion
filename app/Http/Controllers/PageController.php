<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $sizes = Size::all();
        return view('guest.pages.detail', compact('product','categories', 'product_price', 'images', 'sizes'));
    }

    public function get_price(Request $request)
    {
        $id=$request->get('id');
        $product = Product::find($id);
        foreach($product->color as $color){
            if($color->name == $request->color)
//                dd($color->product_price->price);
                echo $color->product_prices->price;

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

    public function show_category($id)
    {
        $product_selected = DB::select(
            'SELECT * FROM products WHERE products.product_type_id IN
            (SELECT type.id FROM product_types as type WHERE (type.parent_category_id = ? ) OR (type.id=?))',[$id, $id]);

        for($i = 0 ; $i <count($product_selected);$i++){
            $product_selected[$i] = [$product_selected[$i]->id];
            // dd($test);
        }

        $products = Product::whereIn('id',$product_selected)->paginate(8);

        $category = ProductCategory::find($id);
        $categories = ProductCategory::all();
        $images = Image::all();
        return view(
            'guest.pages.show_category', compact('products', 'product_selected', 'categories', 'images'));
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
        if($products->count()==0)
            return view('guest.pages.not_found',compact('products','categories', 'images') );
        else
            return view('guest.pages.show_category',compact('products','categories', 'images'));
    }






}
