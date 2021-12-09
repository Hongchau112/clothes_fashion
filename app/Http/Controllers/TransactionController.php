<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Image;
use App\Models\Order;
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
        $transactions = Transaction::paginate(10);
        return view('admin.transactions.index',compact('user', 'transactions'));
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

        $trans = new Transaction();
        $trans->name=$data['name'];
        $trans->address=$data['address'];
        $trans->phone_number=$data['phone_number'];
        $trans->total=$data['total'];
        $trans->email=$data['email'];
        $trans->note=$request->note;
        $trans->payment='Thanh toán khi nhận hàng';
        $trans->status=0;

        $trans->save();
        $trans_id=$trans->id;
        $i=0;
//        dd(session('cart'));
        foreach(session('cart')->products as  $product){
            echo ($product['id']);
            $product_order[$i]=([
                'trans_id' => $trans_id,
                'product_price_id' => $product['price_id'],
                'number' => $product['quanty'],
            ]);
            $i++;
        }
        $trans->orders()->attach($product_order);
        $request->session()->forget('cart');
//        alert()->success('Đặt hàng thành công!');
        SendEmail::dispatch($trans)->delay(now()->addMinute(1));
        return redirect()->route('guest.index');
    }

    public function show($id){
        $user = Auth::guard('admin')->user();
        $trans = Transaction::find($id);
        $orders = Order::all();
        $e = Order::where('trans_id', $trans->id)->get();
        $sizes = Size::all();

        $product_prices = ProductPrice::all();
        foreach ($product_prices as $product_price)
//            dd($product_price->color);

        $products = Product::all();
        return view('admin.transactions.show',compact('user','trans','products', 'orders', 'product_prices', 'sizes'));
    }

    public function edit($id)
    {
        $user = Auth::guard('admin')->user();
        $trans = Transaction::find($id);
        return view('admin.transactions.update_status', compact('trans', 'user'));
    }

    public function update_status(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();

        $validated_data = $request->validate([
            'status' => 'required'
        ]);
        $trans = Transaction::find($id);
        $trans->status = $validated_data['status'];
        $trans->save();

        return redirect()->route('admin.transaction.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');

    }

}
