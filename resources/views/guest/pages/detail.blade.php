@extends('guest.pages.layout', [
    'title' => ($title ?? 'Chi tiết')
])

@section('content')
    <section class="product-detail">
        <div class="container">
            <div class="card-inner">
                <div class="row pb-5" style="margin-right: 0px;">
                    <div class="col-lg-6">
                        <div class="product-gallery mr-xl-1 mr-xxl-5">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <ul id="imageGallery">
                                        @foreach ($images as $i => $image)
                                            <li data-thumb="{{asset('/' . $image->image_path) }}" data-src="{{asset('/' . $image->image_path) }}">
                                                <img  width="100%"  src="{{ asset('/' . $image->image_path) }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Thông tin sản phẩm  -->

                    </div>
                    <div class="col-lg-6">
                        <div class="product-info">
                            <h3 class="product-info-name" >{{ $product->name }}</h3>
                            @foreach ($product->color as $i => $color)
                                @if ($i == 0)
                                    <p class="product-info-price" id="price">{{$color->product_prices->price }} </p>
                                    <input type="hidden" id="get_price" value="{{$color->product_prices->price}}">
                                    <input type="hidden" id="get_price_id"  value="{{$color->product_prices->price_id}}">
{{--                                    <input type="hidden" id="total-quanty" value="{{$color->product_prices->price_id}}">--}}
                                @endif
                            @endforeach
                        </div>
                        <div class="product-meta">
                            <ul class="d-flex g-3 gx-5">
                                <li>
                                    <div class="text-muted">Loại</div>
                                    @foreach ($categories as $cate)
                                        @if ($product->product_type_id == $cate->id)
                                            <div id="product-info2" class="fw-bold text-secondary text-info">{{ $cate->name }}</div>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="product-meta">
                            <h6 class="text-muted">Màu sắc</h6>
                            <ul class="custom-control-group">
                                @foreach ($product->color as $i => $color)
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="color" class="custom-control-input" @if ($i == 0) checked=""
                                               @endif value="{{ $color->name }}" id="colorCheck{{ $i }}">
                                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                                        <label class="custom-control-label" for="colorCheck{{ $i }}">
                                            {{ $color->name }}</label>
                                    </label>
{{--                                    <li>--}}
{{--                                        <div class="custom-control custom-radio  checked">--}}
{{--                                            <input type="button" name="color" class="btn btn-outline-danger" @if ($i == 0) checked--}}
{{--                                                   @endif--}}
{{--                                                   value="{{ $color->name }}" id="colorCheck{{ $i }}">--}}
{{--                                            <input type="hidden" id="product_id" value="{{ $product->id }}">--}}
{{--                                            <label class="custom-control-label" for="colorCheck{{ $i }}">--}}
{{--                                                {{ $color->name }}</label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}

                                @endforeach
                            </ul>
                            <!-- Size-->
                            <h6 class="text-muted">Size</h6>
                            <ul class="custom-control-group">
                                @foreach ($product->size as $i => $size)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="size" class="custom-control-input" @if ($i == 0) checked
                                               @endif
                                               value="{{ $size->name }}" id="sizeCheck{{ $i }}">
                                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                                        <label class="custom-control-label" for="sizeCheck{{ $i }}">
                                            {{ $size->name }}</label>
                                    </div>

                                   <input type="hidden" id="product_id" value="{{ $product->id }}">
                                @endforeach
                            </ul>

                        </div><!-- .product-meta -->
                        {{ csrf_field() }}
                        <div class="product-info-quantity">
                            <div class="quantity buttons-added">
                                <div class="qty mt-5">
{{--                                    <span class="minus bg-dark">-</span>--}}
{{--                                    <input type="number" class="count" name="qty" value="1">--}}
{{--                                    <span class="plus bg-dark">+</span>--}}
{{--                                    <button onclick="AddCart({{$product->id}})" href="javascript:" class="btn-cart" id="cart-button"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ </button>--}}
                                    <a id="add_cart" href="javascript:" style="background: lightsalmon; border: lightcoral; font-family: 'tinymce-mobile', sans-serif" class="btn btn-primary btn-more">THÊM VÀO GIỎ</a>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-desc">
                            <div class="text-muted">Chi tiết sản phẩm</div>
                            <div class=class="col-sm-9" id="product-info"><p>{!! $product->description !!}</p></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
    <!-- xu li chon gia -->
    <script>
        $(document).ready(function(){
            $('input[name=color]').change(function(){
                var color=$('input[name=color]:checked').val();
                var product_id=$('#product_id').val();
                var _token=$('input[name=_token]').val();
                $.ajax({
                    url: "{{route('guest.get_price')}}",
                    type:"POST",
                    data:  {_token:_token, color: color, id: product_id },
                    success: function(result){
                        $('#price').html(result);
                        $('#get_price').attr('value', result);
                    }
                });
            });
        });
    </script>

    <!-- Lay id gia -->
    <script>
        $(document).ready(function(){
            $('input[name=color]').change(function(){
                var color=$('input[name=color]:checked').val();

                var product_id=$('#product_id').val();
                var _token=$('input[name=_token]').val();
                var price_id=$('#get_price_id').val();
                // console.log(price_id);
                $.ajax({
                    url: "{{route('guest.get_price_id')}}",
                    type:"POST",
                    data:  {_token:_token, color: color, id: product_id},
                    success: function(result){
                        $('#get_price_id').attr('value', result);
                    }
                });
            });
        });
    </script>


    <!-- slider anh trong product detail -->
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <!-- Cai them so luong san pham-->
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $('.count').prop('disabled', true);--}}
{{--            $(document).on('click','.plus',function(){--}}
{{--                $('.count').val(parseInt($('.count').val()) + 1 );--}}
{{--            });--}}
{{--            $(document).on('click','.minus',function(){--}}
{{--                $('.count').val(parseInt($('.count').val()) - 1 );--}}
{{--                if ($('.count').val() == 0) {--}}
{{--                    $('.count').val(1);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        $(document).ready(function(){
            $('#add_cart').click(function(){
                var color=$('input[name=color]:checked').val();
                var id=$('#get_price_id').val();
                var size=$('input[name=size]:checked').val();
                var product_id=$('#product_id').val();
                var price=$('#get_price').val();
                console.log(color);
                console.log(price);
                console.log(size);
                console.log(id);
                console.log(product_id);
                $.ajax({
                    url: '/guest/add_cart/' +product_id,
                    type: "GET",
                    data:  {color: color, id: id, size: size, price: price},
                    success: function(result){
                        alert('Thêm sản phẩm thành công!');
                        window.location.reload(true);
                        $('#cart').html(result);
                    }
                });
            });
        });
    </script>

{{--    <script>--}}
{{--        function RenderCart(result) {--}}
{{--            $("#cart").text($('total-quanty-cart').val());--}}
{{--            console.log($("#cart").val());--}}
{{--        }--}}
{{--    </script>--}}


@endpush
