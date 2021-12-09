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
                        <h4 class="title">{{$trans->name}}</h4>
                        <ul class="list-plain">
                            <li><em class="icon ni ni-map-pin-fill"></em><span>{{$trans->address}}<br></span></li>
                            <li><em class="icon ni ni-call-fill"></em><span>{{$trans->phone_number}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-desc">
                    <h3 class="title">Invoice</h3>
                    <ul class="list-plain">
                        <li class="invoice-id"><span>Mã giao dịch</span>:<span>{{$trans->id}}</span></li>
                        <li class="invoice-date"><span>Ngày đặt</span>:<span>{{date('d-m-Y', strtotime($trans->created_at))}}</span></li>
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
                        @foreach($orders as $order)
                            @if($trans->id == $order->trans_id)
                            <tr>
                                @foreach($product_prices as $product_price)
                                    @if($order->product_price_id == $product_price->price_id)
                                        @foreach($products as $product)
                                            @if($product->id == $product_price->product_id)
                                            <td>
                                                    {{$product->name}}
                                            </td>
                                            <td>
                                                {{number_format($product_price->price)}} đ
                                            </td>
                                            <td>
                                              {{$product_price->size}}
                                            </td>

                                            <td>
                                                @php
                                                    $a = $product->color->count()-1;
                                                @endphp
                                                @if($product->color->count() > 1)
                                                    @for($i=0; $i < $a; $i++)
                                                        {{$product->color[$i]->name}},
                                                    @endfor
                                                    {{$product->color[$j]->name}}
                                                @else
                                                    @foreach($product->color as $color)
                                                        {{$color->name}}
                                                    @endforeach
                                                @endif
                                            </td>
                                                @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                </td>
                                            <td>
                                                {{$order->number}}
                                            </td>
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
                            <td colspan="3"> {{number_format($trans->total)}} VND</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="nk-notes ff-italic fs-12px text-soft">  </div>
                </div>
            </div><!-- .invoice-bills -->
        </div><!-- .invoice-wrap -->
    </div>
@endsection
