<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index ()
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();
        $products = Product::paginate(10);
        return view ('admin.products.index', compact('user', 'products', 'product_category'));
    }

    public function create()
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();
        return view('admin.products.create', compact('user', 'product_category'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'product_type_id' => 'required',
            'color' => 'required',
            'price' => 'required',
//            'size' => 'required',
            'file' => 'required'
        ]);

        $color = $data['color'];
        $price = $data['price'];
//        $size = $data['size'];
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->product_type_id = $data['product_type_id'];
        $product->save();

        //Lay id cua san pham
        $insertedId = $product->id;

        //Luu hinh anh vao bang images
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image) {
                $product_image = new Image();
                $product_image->product_id = $insertedId;
                $product_image->image_path = $image->move('storage', $image->getClientOriginalName());
//                dd($product_image->image_path);
                $product_image->save();

            }
        }

        $insertedId = $product->id;
//        dd($insertedId);
        for ($i = 0; $i < count($color); $i++) {
            //Luu mau
            $id = Color::where('name', $color[$i])->first();
            if (!isset($id)){
                $product_color = new Color();
                $product_color->name = $color[$i];
//                $productColor->product_id = $insertedId;
                $product_color->save();
                $id = $product_color->id;
            }
        }

//        for ($i = 0; $i < count($size); $i++) {
//            //Luu mau
//            $id = Size::where('name', $size[$i])->first();
//            if (!isset($id)){
//                $product_size = new Size();
//                $product_size->name = $size[$i];
////                $productColor->product_id = $insertedId;
//                $product_size->save();
//                $id = $product_size->id;
//            }
//        }

        for ($i = 0; $i < count($color); $i++) {
            //Luu mau
//            $id_size = Size::where('name', $color[$i])->first()->id;
            $id_color = Color::where('name', $color[$i])->first()->id;
            $add_color[$i] = [
                'price' => $price[$i],
                'product_id' => $insertedId,
                'color_id' => $id_color,
//                'size_id' => $id_size,
                'date_apply' => now()
            ];
        }
        $product->color()->attach($add_color);

        return redirect()->route('admin.products.index', ['products'])->with('success', 'Add product  success');
    }

    public function show($id)
    {
        $user = Auth::guard('admin')->user();
        $categories = ProductCategory::all();
        $product = Product::find($id);
        $price = ProductPrice::where('product_id', $id)->get();
        $images = Image::all();
        $sizes = Size::all();

        return view('admin.products.show', compact('user', 'categories', 'product', 'price', 'images', 'sizes'));
    }

    public function edit($id)
    {
        $user = Auth::guard('admin')->user();
        $categories = ProductCategory::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('user', 'categories', 'product'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();
        $validated_data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'product_type_id' => 'required'
        ]);


        $product = Product::find($id);

        $product->name = $validated_data['name'];
        $product->description = $validated_data['description'];
        $product->product_type_id = $validated_data['product_type_id'];
        $product->save();
        return redirect()->route('admin.products.index', compact('user', 'product_category'))->with('success', 'Sửa thông tin sản phẩm thành công!');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->color()->detach();
//        $product->color()->detach();
        Product::where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function edit_price($id)
    {
        $user = Auth::guard('admin')->user();
        $product = Product::find($id);
        $prices = ProductPrice::where('product_id', $id)->get();
        $colors = Color::all();
        return view('admin.products.edit_price',compact('user','product', 'prices', 'colors'));

    }

    public function update_price($id,Request $request)
    {
        $data = $request->validate([
            'color' => 'required',
            'price' => 'required'

        ]);
        $color = $data['color'];
        $price = $data['price'];
//        dd($price[0]);

        for ($i = 0; $i < count($color); $i++) {
            //Luu mau
//            $id = Color::with('name')->findOrFail($color[$i]);
            $id_price = Color::where('name',$color[$i])->first();

            if (!isset($id_price)){
                $product_color = new Color();
                $product_color->name = $color[$i];
                $product_color->save();
                $id_price = $product_color->id;
            }
        }

        $product = Product::find($id);

        for ($i = 0; $i < count($color); $i++) {
            //Luu mau
            $id_color = Color::where('name', $color[$i])->first()->id;
            $add_color[$i] = [
                'price' => $price[$i],
                'product_id' => $product->id,
                'color_id' => $id_color,
                'date_apply' => now()
            ];
        }

        $product->color()->sync($add_color);
        return redirect()->route('admin.products.index')->with('success','Đã cập nhật lại giá sản phẩm thành công!');
    }

    public function add_size()
    {
        $user = Auth::guard('admin')->user();
//        $product_category = ProductCategory::all();
        return view('admin.products.size', compact('user'));
    }

    public function store_size(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();
        $products = Product::paginate(10);
        $data = $request->validate([
            'name' => 'required'
            ]);
        $size = new Size();
        $size->name = $data['name'];
        $size->save();

        return redirect()->route('admin.products.index', compact('user', 'products', 'product_category'))->with('success', 'Thêm size thành công!');

    }





}
