@extends('admin.products.layout', [
    'title' => ( $title ?? 'Chi tiết sản phẩm' )
])

@section('content')
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="row pb-5">
                    <div class="col-lg-6">
                        @foreach($images as $image)
                            @if($image->product_id == $product->id)
                                <img class="product-images" rc="{{asset('/'.$image->image_path)}}" alt="product_image" height="300" style="padding-bottom: 20px">
                            @endif
                        @endforeach

                    </div><!-- .col -->
                    <div class="col-lg-6">
                        <div class="product-info mt-5 mr-xxl-5">
                            <h4 class="product-price text-primary">$78.00 <small class="text-muted fs-14px"></small></h4>
                            <h2 class="product-title">{{$product->name}}</h2>
                            <div class="product-meta">
                                <ul class="d-flex g-3 gx-5">
                                    <li>
                                        <div class="fs-14px text-muted">Loại sản phẩm</div>
                                        <div class="fs-16px fw-bold text-secondary">
                                            @foreach($categories as $category)
                                                @if($product->category_id==$category->id)
                                                    <div>{{$category->name}}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-meta">
                                <ul class="d-flex g-3 gx-5">
                                    <li>
                                        <div class="fs-14px text-muted">Giá</div>
                                        <div class="fs-16px fw-bold text-secondary">
                                            @foreach($price as $product_price)
                                                <div class="price h4" id="price">{{$product_price->price}}</div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-meta">
                                <h6 class="title">Size</h6>
                                <ul class="custom-control-group">
                                    @foreach($product->size as $size)
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control checked">
                                                <input type="radio" class="custom-control-input" name="sizeCheck" id="sizeCheck1">
                                                <label class="custom-control-label" for="sizeCheck1">{{$size->name}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- .product-meta -->

                            <div class="product-meta">
                                <h6 class="title">Màu</h6>
                                <ul class="custom-control-group">
                                    @foreach($product->color as $color)
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control checked">
                                                <input type="radio" class="custom-control-input" name="colorCheck" id="colorCheck1">
                                                <label class="custom-control-label" for="sizeCheck1">{{$color->name}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- .product-meta -->

                            <div class="product-excrept text-soft">
                                <dt class="title">Mô tả</dt>
                                <p class="lead">{!!$product->description!!}</p>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .col -->
                </div><!-- .row -->
                <hr class="hr border-light">
            </div>
        </div>
    </div>
@endsection
