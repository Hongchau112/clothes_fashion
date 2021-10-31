@extends('admin.products.layout', [
    'title' => ( $title ?? 'Cập nhật giá của sản phẩm' )
])

@section('content')
    <div class="card card-bordered">
        <div class="card-inner">
            <form class="form-validate" action="{{route('admin.products.update_price',['id'=>$product->id])}}" id="dynamic_form" novalidate="novalidate" method="POST" >
                @csrf
                <div class="row g-gs">
                    <div class="col-md-6">
                        <label class="form-label" for="">Add Price</label>
                        <table class="" id="dynamicAddRemove">
                            @foreach($prices as $price)
                                <tr>
{{--                                    Goi danh sách màu ra để so sánh rồi lấy tên màu--}}
                                    @foreach($colors as $color)
                                        @if ($price->color_id == $color->id)
                                            <td><input type="text" name="color[0]" placeholder="Enter color" class="form-control"  value="{{$color->name}}" /></td>
                                        @endif
                                    @endforeach
                                    {{--                                    Goi danh sách size ra để so sánh rồi lấy tên màu--}}

                                @foreach($sizes as $size)
                                        @if ($price->size_id == $size->id)
                                            <td><input type="text" name="size[0]" placeholder="Enter size" class="form-control"  value="{{$size->name}}" /></td>
                                        @endif
                                    @endforeach
                                    <td><input type="text" name="price[0]" placeholder="Enter price" class="form-control" value="{{$price->price}}"/></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Price</button></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" id="button" class="btn btn-lg btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="color[' + i +
                ']" placeholder="Enter color" class="form-control" /></td><td><input type="text" name="size[' + i +
                ']" placeholder="Enter size" class="form-control" /></td> <td><input type="text" name="price['+ i +
                ']" placeholder="Enter price" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
