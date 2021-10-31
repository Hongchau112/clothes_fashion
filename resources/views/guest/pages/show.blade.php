@extends('guest.pages.layout', [
'title' => ( $title ?? 'Trang chủ' )
])

@section('content')
    <!-- Product -->
    <section class="all_product">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    @php
                        $i = 0;
                    @endphp
                    <div class="col-3 mb-5 " style="padding-left:18px">
                        <div class="card" style="width: 18.4rem;">
                            <a href="{{route('guest.detail', ['id' => $product->id])}}">
                                @foreach ($images as $image)
                                    @if ($image->product_id == $product->id && $i == 0)
                                        <img width="200px" height="270px" class="card-img-top"
                                             src="{{ asset('/' . $image->image_path) }}"
                                             alt="Card image cap">
                                        @php
                                            $i = 1;
                                        @endphp
                                    @endif
                                @endforeach
                            </a>

                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: 750; font-family: 'Source Serif Pro', serif">{{ $product->name }}</h5>
{{--                                <p class="card-text">{!! $product->description !!}</p>--}}
{{--                                @foreach ($product->color as $i => $color)--}}

{{--                                    @if ($i == 0)--}}

{{--                                        <p class="product__info--price" id="price">{{ $color->product_prices->price }}₫</p>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}

                                <a href="{{route('guest.detail', ['id' => $product->id])}}" style="background: lightsalmon; border: lightcoral; font-family: 'tinymce-mobile', sans-serif" class="btn btn-primary btn-more">THÊM VÀO GIỎ</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

{{--            <span>--}}
{{--                {!! $products->links('pagination::bootstrap-4') !!}--}}

{{--            </span>--}}
        </div>

    </section>

@endsection
