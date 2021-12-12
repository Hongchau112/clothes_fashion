@extends('guest.pages.layout', [
'title' => ( $title ?? 'Loại sản phẩm' )
])

@section('content')
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
                                @if($product->color->count()>1)
                                    @php
                                        $a = $product->color[0]->product_prices->price;
                                        $b = $product->color[0]->product_prices->price;
                                        $c=0;
                                        foreach($product->color as $price)
                                            {
                                                if($price->product_prices->price > $a)
                                                    $a = $price->product_prices->price;
                                                if($price->product_prices->price < $b)
                                                    $b = $price->product_prices->price;
                                            }
                                        if($a>$b)
                                            {
                                                $c=$a;
                                                $a=$b;
                                                $b=$c;
                                            }
                                    @endphp
                                    <p style="font-family: 'Arial'; color: indianred; font-size: 19px; ">{{number_format($a)}}<span class="price-item" style="font-size: 13px; text-decoration: underline;" >đ</span> - {{number_format($b)}}<span class="price-item" style="font-size: 13px; text-decoration: underline;">đ</span></p>
                                @else
                                    @foreach($product->color as $color)
                                        <p style="font-family: 'Arial'; color: indianred; font-size: 19px; ">{{number_format($color->product_prices->price)}}<span class="price-item" style="font-size: 13px; text-decoration: underline; ">đ</span></p>
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

