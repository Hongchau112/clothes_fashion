@extends('admin.product_categories.layout', [
    'title' => ( $title ?? 'Danh mục sản phẩm' )
])

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
{{--                        <div>--}}
{{--                            @if($category->count() == 0)--}}
{{--                                <div class="card-inner p-0">--}}
{{--                                    <div class="alert m-0">--}}
{{--                                        <div class="alert alert-warning alert-icon">--}}
{{--                                            <em class="icon ni ni-alert-circle"></em> Bạn chưa có loại sản phẩm, <a href="{{ route('product_category.create') }}">tạo loại sản phẩm</a>.--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh mục sản phẩm</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                            </div>
                                        </li>
{{--                                        <li>--}}
{{--                                            <div class="drodown">--}}
{{--                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Status</a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <ul class="link-list-opt no-bdr">--}}
{{--                                                        <li><a href="#"><span>New Items</span></a></li>--}}
{{--                                                        <li><a href="#"><span>Featured</span></a></li>--}}
{{--                                                        <li><a href="#"><span>Out of Stock</span></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
                                        <li class="nk-block-head-content">
                                            <a href="{{route('product_categories.create')}}" data-target="addProduct" class="btn btn-primary"><em class="icon ni ni-plus"></em><span class="d-none d-md-block">Thêm danh mục</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid">
                                                <label class="custom-control-label" for="pid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Tên danh mục</span></div>
                                        <div class="nk-tb-col"><span>Mô tả</span></div>
                                        <div class="nk-tb-col"><span>Danh mục cha</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Selected</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($product_category as $cate)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid{{$cate->id}}">
                                                <label class="custom-control-label" for="uid{{$cate->id}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{$cate->name}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">{{$cate->description}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div>
                                                @if ($cate->parent_category_id == 0)
                                                    <span class="tb-sub">Thư mục gốc</span>
                                                @else
                                                    @foreach($product_category as $cate_sub)
                                                        @if ($cate_sub->id == $cate->parent_category_id)
                                                            <span class="tb-sub">{{$cate_sub->name}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{route('product_categories.edit', ['id' => $cate->id])}}"><em class="icon ni ni-edit"></em><span>Sửa</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>Xem</span></a></li>
                                                                <li><a href="{{route('product_categories.delete', ['id' => $cate->id])}}"><em class="icon ni ni-trash"></em><span>Xóa</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div><!-- .nk-tb-list -->

                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
{{--                                        <ul class="pagination justify-content-center justify-content-md-start">--}}
{{--                                            <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#">6</a></li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#">7</a></li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-right"></em></a></li>--}}
{{--                                        </ul><!-- .pagination -->--}}
                                    </div>
{{--                                    <div class="g">--}}
{{--                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">--}}
{{--                                            <div>Page</div>--}}
{{--                                            <div>--}}
{{--                                                <select class="form-select form-select-sm" data-search="on" data-dropdown="xs center">--}}
{{--                                                    <option value="page-1">1</option>--}}
{{--                                                    <option value="page-2">2</option>--}}
{{--                                                    <option value="page-4">4</option>--}}
{{--                                                    <option value="page-5">5</option>--}}
{{--                                                    <option value="page-6">6</option>--}}
{{--                                                    <option value="page-7">7</option>--}}
{{--                                                    <option value="page-8">8</option>--}}
{{--                                                    <option value="page-9">9</option>--}}
{{--                                                    <option value="page-10">10</option>--}}
{{--                                                    <option value="page-11">11</option>--}}
{{--                                                    <option value="page-12">12</option>--}}
{{--                                                    <option value="page-13">13</option>--}}
{{--                                                    <option value="page-14">14</option>--}}
{{--                                                    <option value="page-15">15</option>--}}
{{--                                                    <option value="page-16">16</option>--}}
{{--                                                    <option value="page-17">17</option>--}}
{{--                                                    <option value="page-18">18</option>--}}
{{--                                                    <option value="page-19">19</option>--}}
{{--                                                    <option value="page-20">20</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div>OF 102</div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .pagination-goto -->--}}
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
{{--                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>--}}
{{--                    <div class="nk-block-head">--}}
{{--                        <div class="nk-block-head-content">--}}
{{--                            <h5 class="nk-block-title">New Product</h5>--}}
{{--                            <div class="nk-block-des">--}}
{{--                                <p>Add information and add new product.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- .nk-block-head -->--}}
{{--                    <div class="nk-block">--}}
{{--                        <div class="row g-3">--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="product-title">Product Title</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="product-title">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="regular-price">Regular Price</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="regular-price">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="sale-price">Sale Price</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="sale-price">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="stock">Stock</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="stock">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="SKU">SKU</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="SKU">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="category">Category</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="category">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="tags">Tags</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control" id="tags">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="upload-zone small bg-lighter my-2">--}}
{{--                                    <div class="dz-message">--}}
{{--                                        <span class="dz-message-text">Drag and drop file</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- .nk-block -->--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection


