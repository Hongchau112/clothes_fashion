@extends('admin.products.layout', [
    'title' => ( $title ?? 'Tạo sản phẩm mới' )
])

@section('content')

    <div class="card card-bordered">
        <div class="card-inner">
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card-inner card-inner-sm">
                            <form action="{{route('admin.products.store_size')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="size">Size<span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Size" required>
                                    </div>
                                    <div class="col-lg-6 col-md-8 text-right">
                                        <div class="form-group mt-1 ">
                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                        </div>
                                    </div>
                                    <div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
