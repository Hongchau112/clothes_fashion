@extends('admin.transactions.layout', [
    'title' => ( $title ?? 'Chi tiết đặt hàng' )
])

@section('content')
    <div class="invoice">
        <div class="invoice-wrap">
            <div class="invoice-head">
                <div class="invoice-contact">
                    <span class="overline-title">GIAO DỊCH</span>
                    <div class="invoice-contact-info">
                        <h4 class="title">{{$order->name}}</h4>
                        <ul class="list-plain">
                            <li><em class="icon ni ni-map-pin-fill"></em><span>{{$order->address}}<br></span></li>
                            <li><em class="icon ni ni-call-fill"></em><span>{{$order->phone_number}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-desc">
                    <h3 class="title">Invoice</h3>
                    <ul class="list-plain">
                        <li class="invoice-id"><span>Mã giao dịch</span>:<span>{{$order->id}}</span></li>
                        <li class="invoice-date"><span>Ngày đặt</span>:<span>{{date('d-m-Y', strtotime($order->created_at))}}</span></li>
                    </ul>
                </div>
            </div><!-- .invoice-head -->
            <div class="invoice-bills">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="w-400px">Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Size</th>
                            <th class="">Màu</th>
                            <th id="number-quanty" class="w-100px">Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_details as $order_detail)
                            @if($order_detail->order_id == $order->id)
                                <tr>
                                <td>{{$order_detail->product_name}}</td>
                                <td>{{number_format($order_detail->product_price)}}</td>
                                <td>{{$order_detail->size}}</td>
                                <td>{{$order_detail->color}}</td>
                                <td>{{$order_detail->number}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <td></td>
                        <td></td>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng tiền</td>
                            <td colspan="3"> {{number_format($order->total)}} VND</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="nk-notes ff-italic fs-12px text-soft">  </div>
                </div>
            </div><!-- .invoice-bills -->
        </div><!-- .invoice-wrap -->
    </div>
@endsection
