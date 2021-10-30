@extends('guest.pages.layout', [
'title' => ( $title ?? 'Trang chủ' )
])

@section('content')
{{--    <section class="clothes-section">--}}
{{--        <div class="container">--}}
{{--            <div class="card-inner">--}}


{{--            </div>--}}
{{--        </div>--}}

{{--    </section>--}}
    <section class="carouselBanner">
        <div id="carouselCosmetics" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselCosmetics" data-slide-to="0" class="active"></li>
                <li data-target="#carouselCosmetics" data-slide-to="1"></li>
                <li data-target="#carouselCosmetics" data-slide-to="2"></li>
            </ol>
{{--            <div class="carousel-inner">--}}
{{--                <div class="carousel-item active" >--}}
{{--                    <img class="w-100" src="{{asset('mystore/img/MYS-1.png')}}" alt="First slide">--}}
{{--                </div>--}}
{{--                <div class="carousel-item">--}}
{{--                    <img class="w-100" src="{{asset('mystore/img/MYS-2.png')}}" alt="Second slide">--}}
{{--                </div>--}}

{{--                <div class="carousel-item">--}}
{{--                    <img class="w-100" src="{{asset('mystore/img/MYS-3.png')}}" alt="Third slide">--}}
{{--                </div>--}}

{{--            </div>--}}
            <a class="carousel-control-prev" href="#carouselCosmetics" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselCosmetics" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <!--Hien thi tat ca san pham -->
    <section class="all_product">
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                @php
                    $i = 0;
                @endphp
                <div class="col-3 mb-5">
                    <div class="card">
                        <a href="{{route('guest.detail', ['id' => $product->id])}}" id="image-thumbnail-index">
                            @foreach ($images as $image)
                                @if ($image->product_id == $product->id && $i == 0)
                                    <img id="image-thumbnail"
                                         src="{{ asset('/' . $image->image_path) }}" alt="Card image cap">
                                    @php
                                        $i = 1;
                                    @endphp
                                @endif
                            @endforeach
                        </a>
                        <div class="card-body">
                            <div class="card-title" style="margin-top: -10px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;margin-bottom: 5px;font-family: 'Arial'; font-size: 15px; height: 30px; width: 180px;">{{ $product->name }}</div>
                            @if($product->color->count()==2)
                                <p style="font-family: 'Arial'; color: indianred; font-size: 19px; ">{{$product->color[0]->product_prices->price}}<span class="price-item" style="font-size: 13px; text-decoration: underline;" >đ</span> - {{$product->color[1]->product_prices->price}}<span class="price-item" style="font-size: 13px; text-decoration: underline;">đ</span></p>
                            @else
                                @foreach($product->color as $color)
                                    <p style="font-family: 'Arial'; color: indianred; font-size: 19px; ">{{$color->product_prices->price}}<span class="price-item" style="font-size: 13px; text-decoration: underline; ">đ</span></p>
                                @endforeach
                            @endif
                            <a  href="{{route('guest.detail', ['id' => $product->id])}}" style="background: lightsalmon; border: lightcoral; font-family: 'tinymce-mobile', sans-serif; font-size: 13px; margin-top: -15px;" class="btn btn-primary btn-more">XEM CHI TIẾT</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-inner" id="card-inner-id">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {!!$products->links('pagination::bootstrap-4')!!}
                </div>
            </div><!-- .nk-block-between -->
        </div>
    </div>

</section>
@endsection

