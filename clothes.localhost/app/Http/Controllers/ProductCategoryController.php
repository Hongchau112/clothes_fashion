<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::paginate(10);
        return view('admin.product_categories.index', compact('user','product_category'));
    }

    public function create()
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::all();
        return view('admin.product_categories.create', compact('user', 'product_category'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $validated_data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_category_id' => 'required',
        ]);
//        var_dump($validated_data);exit();
        $product_category = new ProductCategory();
        $product_category->name = $validated_data['name'];
        $product_category->description = $validated_data['description'];
        $product_category->parent_category_id = $validated_data['parent_category_id'];
        $product_category->save();

        return redirect()->route('admin.product_categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit($id)
    {
        $user = Auth::guard('admin')->user();
        $product_category = ProductCategory::find($id);
        $categories = ProductCategory::all();
        return view('admin.product_categories.edit', compact('user', 'product_category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();
        $validated_data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_category_id' => 'required',
        ]);

        $product_category = ProductCategory::find($id);
        $product_category->name = $validated_data['name'];
        $product_category->description = $validated_data['description'];
        $product_category->parent_category_id = $validated_data['parent_category_id'];
        $product_category->save();

        return redirect()->route('admin.product_categories.index')->with('success', 'Sửa danh mục thành công!');
    }

    public function delete($id)
    {
        ProductCategory::where('id', $id)->delete();
        return redirect()->route('admin.product_categories.index')->with('success', 'Xóa danh mục thành công!');
    }

}
