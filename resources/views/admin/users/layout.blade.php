@extends('admin.layout', [
    'title' => ( $title ?? 'Chỉnh sửa tài khoản' )
])

@section('main')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body"><div class="nk-block-head nk-block-head-sm">
                        <ul class="breadcrumb breadcrumb-arrow">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Quản lý tài khoản</li>
                        </ul>
                    </div><!-- .breadcrumb -->
                    <div class="nk-block-head ">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
{{--                                <h3 class="nk-block-title page-title">Danh sách tài khoản</h3>--}}
                            </div><!-- .nk-block-head-content -->
                            @can('user.create')
                                <div class="nk-block-head-content">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em><span class="d-none d-md-block">@lang('New users')</span>
                                    </a>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            @endcan
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

@endsection
