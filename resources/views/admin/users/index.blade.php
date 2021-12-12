@extends('admin.users.layout', [
'title' => ( $title ?? 'Quản lý tài khoản' )
])

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-inner p-0">
        <div class="nk-tb-list nk-tb-ulist">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col nk-tb-col-check">
                    <div class="custom-control custom-control-sm custom-checkbox notext">
{{--                        <input type="checkbox" class="custom-control-input" id="uid">--}}
{{--                        <label class="custom-control-label" for="uid"></label>--}}
                    </div>
                </div>
                <div class="nk-tb-col"><span class="sub-text">Tên người dùng</span></div>
                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Email</span></div>
                <div class="nk-tb-col tb-col-md"><span class="sub-text">Trạng thái</span></div>
                <div class="nk-tb-col nk-tb-col-tools">
                </div>
            </div>
            @foreach($user_list as $user_sub)
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
{{--                            <input type="checkbox" class="custom-control-input" id="uid{{$user_sub->id}}">--}}
{{--                            <label class="custom-control-label" for="uid{{$user_sub->id}}"></label>--}}
                        </div>
                    </div>
                    <div class="nk-tb-col">
                        <div class="user-card">
                            <div class="user-info">
                                <span class="tb-lead">{{$user_sub->name}}<span class="dot dot-success d-md-none ml-1"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                        <ul class="list-status">
                            <li><em class="icon text-success ni ni-check-circle"></em> <span>{{$user_sub->email}}</span></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        @if ($user_sub->status == 1)
                            <span class="tb-status text-success">Kích hoạt</span>
                        @else
                            <span class="tb-status text-danger">Bị khóa</span>
                        @endif
                    </div>
                    <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="{{ route('admin.show', ['id' => $user_sub->id]) }}"><em class="icon ni ni-eye"></em><span>Xem</span></a></li>
                                            <li><a href="{{ route('admin.edit', ['id' => $user_sub->id]) }}"><em class="icon ni ni-edit"></em><span>Chỉnh sửa</span></a></li>
                                            <li><a href="{{ route('admin.edit_password', ['id' => $user_sub->id]) }}"><em class="icon ni ni-repeat"></em><span>Đổi mật khẩu</span></a></li>
                                            <li><a href="{{ route('admin.block', ['id' => $user_sub->id]) }}"><em class="icon ni ni-na"></em>
                                                    @if ($user_sub->status == 1)
                                                        <span>Chặn</span>
                                                    @else
                                                        <span >Gỡ chặn</span>
                                                    @endif
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .nk-tb-item -->
            @endforeach
        </div><!-- .nk-tb-list -->
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
{{--                    <div class="card-inner" id="card-inner-id">--}}
{{--                        <div class="nk-block-between-md g-3">--}}
{{--                            <div class="g">--}}
{{--                                {!!$products->links('pagination::bootstrap-4')!!}--}}
{{--                            </div>--}}
{{--                        </div><!-- .nk-block-between -->--}}
{{--                    </div>--}}
                    <ul class="pagination justify-content-center justify-content-md-start">
                        {!!$user_list->links('pagination::bootstrap-4')!!}
                    </ul><!-- .pagination -->
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .card-inner -->
    </div>
@endsection
