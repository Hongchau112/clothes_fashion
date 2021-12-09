<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Size;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Nullable;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $orders = Order::paginate(10);
        return view('admin.transactions.index',compact('user', 'orders'));
    }

    public function success()
    {
        $images = Image::all();
        $user = Auth::guard('admin')->user();
        $categories = ProductCategory::all();
        $products = Product::all();
        return view('guest.pages.alert',compact('categories', 'products', 'images'));
    }

    public function store(Request $request){
        $products = Product::all();
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'payment' => 'required',
            'total' => 'required',
            'note' => 'nullable'
        ]);

        $order = new Order();
        $order->name=$data['name'];
        $order->address=$data['address'];
        $order->phone_number=$data['phone_number'];
        $order->total=$data['total'];
        $order->email=$data['email'];
        $order->note=$request->note;
        $order->payment='Thanh toán khi nhận hàng';
        $order->status=0;

        $order->save();
        $order_id=$order->id;
        $i=0;

        foreach(session('cart')->products as  $product){
            $product_order[$i]=([
                'order_id' => $order_id,
                'product_price' => $product['price'],
                'number' => $product['quanty'],
                'product_id' => $product['id'],
                'product_name' => $product['product']->name,
                'size' => $product['size'],
                'color' => $product['color']
            ]);
            $i++;
        }
        $order->orders()->attach($product_order);
        $request->session()->forget('cart');
        SendEmail::dispatch($order)->delay(now()->addMinute(1));
        return redirect()->route('guest.index');
    }

    public function show($id){
        $user = Auth::guard('admin')->user();
        $order = Order::find($id);
        $order_details = OrderDetail::all();
//        $e = Order::where('order_id', $order->id)->get();
//        $sizes = Size::all();
        $products = Product::all();
//        dd($order_details);
        return view('admin.transactions.show',compact('user','order','products', 'order_details'));
    }

    public function edit($id)
    {
        $user = Auth::guard('admin')->user();
        $order = Order::find($id);
        return view('admin.transactions.update_status', compact('order', 'user'));
    }

    public function update_status(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();

        $validated_data = $request->validate([
            'status' => 'required'
        ]);
        $order = Order::find($id);
        $order->status = $validated_data['status'];
        $order->save();

        return redirect()->route('admin.transaction.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');

    }

}
