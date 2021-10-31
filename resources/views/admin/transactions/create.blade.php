@extends('guest.pages.layout', [
    'title' => ($title ?? 'Đặt hàng')
])

@section('content')
    <div class="order">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Đặt hàng</h4>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Họ và tên *</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Số điện thoại *</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="mb-3">--}}
                    {{--                        <label for="email">Email <span class="text-muted">(Optional)</span></label>--}}
                    {{--                        <input type="email" class="form-control" id="email" placeholder="you@example.com">--}}
                    {{--                        <div class="invalid-feedback">--}}
                    {{--                            Please enter a valid email address for shipping updates.--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="Ví dụ: 95/30 Mậu Thân" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập địa chỉ giao hàng
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <div >

                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" id="order-button" type="submit">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('footer')
@endpush

