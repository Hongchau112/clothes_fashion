@extends('guest.pages.layout', [
    'title' => ($title ?? 'Chi tiết giỏ hàng')
])

@section('content')
    <section class="shopping-cart">
        <div class="container">
            <div class="row" style="margin-right: -15px;">
                <div class="col-lg-12">
                    <div class="cart-table">

                        <table>
                            @if(Session::has('cart') != null)
                                <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th class="p-name">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Size</th>
                                    <th>Màu sắc</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                @foreach(Session::get('cart')->products as $product)

                                <tbody>
                                <tr>
                                    <td class="cart-pic first-row" >
                                        @php
                                          $i=0;
                                        @endphp
                                        @foreach ($images as $image)
                                            @if ($image->product_id == $product['id'] && $i == 0)
                                                <img class="card-img-top"
                                                     src="{{ asset('/' . $image->image_path) }}"
                                                     alt="Card image cap">
                                                @php
                                                    $i = 1;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="">{{$product['product']->name}}</td>

                                    <td class="" id="priceshow{{$product['price_id']}}">{{number_format($product['price']/$product['quanty'])}}</td>
{{--                                    <td class="p-price first-row" id="priceshow{{$product['price_id']}}">{{$product['price']}}</td>--}}
                                    <input type="hidden" id="price{{$product['price_id']}}" value="{{$product['price']}}">
                                    <input type="hidden" class="idPrice" value=" {{$product['price_id'] }} ">

                                    <td class="qua-col first-row">
                                        <div class="size">
                                            <div class="pro-qty">
                                                <span class="minus-quanty" onclick="deleteNumberItem('{{$product['price_id'] }}')">-</span>
                                                <input type="text" id="quantyProduct{{$product['price_id'] }}" value="{{$product['quanty']}}">
                                                <span class="plus-quanty" onclick="addNumberItem('{{$product['price_id'] }}')">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size">{{$product['size']}}</td>
                                    <td class="color">{{$product['color']}}</td>
                                    <td class="close-td first-row"><button class="delete-item" onclick="deleteCart('{{$product['price_id'] }}')">Xóa</button></td>

                                </tr>

                            </tbody>
                                @endforeach
                            @else
                                <div>
                                    <div style="margin-top: -40px!important; margin-left: 160px;">Bạn chưa chọn sản phẩm nào.</div>
                                    <img src="{{asset('/mystore/img/empty-cart.png')}}" width="40%" style=" margin-left: 400px">
                                </div>
                            @endif
                        </table>
                    </div>
                    @if(Session::has('cart') != null)
                        <div class="row" style="margin-right: -15px;">
                            <div class="col-lg-4 offset-lg-8">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">Tổng số lượng <span>{{Session::get('cart')->total_quanty}}</span></li>
                                        <li class="cart-total">Tổng tiền <span>{{number_format(Session::get('cart')->total_price)}} vnd</span></li>
                                        <input type="hidden" id="total-quanty-cart" value="{{Session::get('cart')->total_quanty}}">
                                    </ul>
                                    <a href="{{route('guest.order')}}" class="proceed-btn">Xử lý đặt hàng</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer')
    <script>
        function deleteCart(id){
            $.ajax({
                url: "/guest/delete_cart/" +id,
                type:"GET",
                success: function(result){
                    console.log(result);
                    $('#shopping-cart').empty();
                    $('#shopping-cart').html(result);
                    $('#cart').text($('#total_quanty').val())
                    console.log($('#totalquanty').val());
                    alert('Delete successfully!');
                    window.location.reload(true);
                }
            });
        };
    </script>

    <script>
        function deleteNumberItem(id){
            var priceItems=$('#price'+id).val();
            var number=$('#quantyProduct'+id).val();
            var price = priceItems/number;
            // console.log(price);
            if(number==1){
                $('#quantyProduct'+id).attr('value',number);
                $('#price'+id).attr('value',price);
                $('#priceshow'+id).html(price);
            }else{
                number--;
                $('#quantyProduct'+id).attr('value',number);
                $('#price'+id).attr('value',price*number);
                $('#priceshow'+id).html(price);
                $.ajax({
                    url: "/guest/update_cart/" +id,
                    type:"GET",
                    data:  {number:number,price:price},
                    success: function(result){
                        $('#shopping-cart').empty();
                        $('#shopping-cart').html(result);
                        window.location.reload(true);
                        $('#cart').text($('#total-quanty-cart').val())
                    }
                });
            }

        };
    </script>

    <script>
        function addNumberItem(id){
            var priceItems=$('#price'+id).val();
            var number=$('#quantyProduct'+id).val();
            var price= priceItems/number;
            number++;
            $('#quantyProduct'+id).attr('value',number);
            $('#price'+id).attr('value',price*number);
            $('#priceshow'+id).html(price);
            $.ajax({
                url: "/guest/update_cart/" +id,
                type:"GET",
                data:  {number:number,price:price},
                success: function(result){
                    $('#shopping-cart').empty();
                    $('#shopping-cart').html(result);
                    window.location.reload(true);
                    $('#cart').text($('#total-quanty-cart').val())
                }
            });
        };
    </script>


@endpush

