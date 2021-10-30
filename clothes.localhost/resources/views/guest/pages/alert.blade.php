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
            <div class="carousel-inner">
                <div class="carousel-item active" >
                    <img class="w-100" src="{{asset('mystore/img/MYS-1.png')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{asset('mystore/img/MYS-2.png')}}" alt="Second slide">
                </div>

                <div class="carousel-item">
                    <img class="w-100" src="{{asset('mystore/img/MYS-3.png')}}" alt="Third slide">
                </div>

            </div>
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
                    <div class="col-3 mb-5 " style="padding-left:50px">
                        <div class="card">
                            <a href="{{route('guest.detail', ['id' => $product->id])}} " >
                                @foreach ($images as $image)
                                    @if ($image->product_id == $product->id && $i == 0)
                                        <img width="230px" height="260px"
                                             src="{{ asset('/' . $image->image_path) }}" style="margin-left: 10px"
                                             alt="Card image cap">
                                        @php
                                            $i = 1;
                                        @endphp
                                    @endif
                                @endforeach
                            </a>

                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: 750; font-family: 'Source Serif Pro', serif">{{ $product->name }}</h5>
                                <a onclick="AddCart({{$product->id}})" href="javascript:" style="background: lightsalmon; border: lightcoral; font-family: 'tinymce-mobile', sans-serif" class="btn btn-primary btn-more">THÊM VÀO GIỎ</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-inner" id="card-inner-id">
                <div class="nk-block-between-md g-3">
{{--                    <div class="g">--}}
{{--                        {!!$products->links('pagination::bootstrap-4')!!}--}}
{{--                    </div>--}}
                </div><!-- .nk-block-between -->
            </div>
        </div>

    </section>

@endsection
@push('footer')
        <script>
            title = document.getElementsByClassName('ajs-header');
            title.innerHTML = "Thông báo";
            alertify
                .alert("Bạn đã đặt hàng thành công!", function(){
                });
</script>
@endpush

