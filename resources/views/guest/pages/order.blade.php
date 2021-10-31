@extends('guest.pages.layout', [
    'title' => ($title ?? 'Đặt hàng')
])
<style>
    <link rel="stylesheet" href="{{asset('mystore/css/order.css')}}">
</style>
@section('content')
    <div class="order">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Đặt hàng</h4>
                <form class="needs-validation" action="{{route('guest.transaction.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Họ và tên *</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Vui lòng nhập họ và tên" required>
{{--                            <div class="invalid-feedback">--}}
{{--                                Vui lòng nhập vào tên hợp lệ--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Số điện thoại *</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"  required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Ví dụ: 95/30 Mậu Thân, Xuân Khánh, Ninh Kiều, Cần Thơ" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập địa chỉ giao hàng
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Ví dụ: hongchau123@gmail.com" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập địa chỉ mail
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Note</label>
                        <textarea class="form-control" id="note" name="note" placeholder="Ví dụ: Hàng dễ vỡ, xin nhẹ tay" required></textarea>
                    </div>

                    <div class="mb-3">
                        <h4 class="order__title">Đơn hàng của bạn</h4>
                        <div class="total-price" id="total-price">
                            <ul>
                                <li class="subtotal">Số sản phẩm <span id="item">{{Session::get('cart')->total_quanty}}</span></li>
                                <li class="cart-total">Tổng tiền <span id="total">{{number_format(Session::get('cart')->total_price)}} VND</span></li>
                                <input type="hidden" id="total-quanty-cart" value="{{Session::get('cart')->total_quanty}}">
                                <input type="hidden" name="total" value="{{Session::get('cart')->total_price}}">
                            </ul>
                        </div>
                    </div>

                    <div class="checkout__input__checkbox">
                        <label for="payment">
                            Thanh toán trực tiếp khi nhận hàng
                            <input type="checkbox" name="payment" id="payment">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkout__input__checkbox">
                        <label for="paypal">
                            Thanh toán qua khoản ngân hàng
                            <input type="checkbox" id="paypal">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block"  id="order-button" type="submit">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('footer')

    <script>
        function alert(){
            $(document).ready(function(){
                $('#order-button').on('click', function (){
                    alertify
                        .alert("Bạn đã đặt hàng thành công!", function(){
                        });
                });
            })
        }
    </script>
@endpush
