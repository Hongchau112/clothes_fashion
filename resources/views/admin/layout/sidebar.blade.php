<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="\admin" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('/dashlite/images/logo.png') }}"  alt="logo" style="width: 120px">
                <img class="logo-dark logo-img" src="{{ asset('/dashlite/images/logo.png') }}"  alt="logo-dark" style="width: 120px">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboards</h6>
                    <li class="nk-menu-item {{request()->segment(2) == 'users' ? 'active current-page' : ''}}">
                        <a href="{{route('admin.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Người dùng</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item {{request()->segment(2) == 'product_categories' ? 'active current-page' : ''}}">
                        <a href="{{route('admin.product_categories.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-grid-alt"></em></span>
                            <span class="nk-menu-text">Danh mục sản phẩm</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub {{request()->segment(2) == 'products' ? 'active current-page' : ''}}">
                        <a href="{{route('admin.products.index')}}" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text">Sản phẩm</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.products.index')}}" class="nk-menu-link"><span class="nk-menu-text">Danh sách</span></a>
                                <a href="{{route('admin.products.add_size')}}" class="nk-menu-link"><span class="nk-menu-text">Thêm size</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item {{request()->segment(2) == 'transactions' ? 'active current-page' : ''}}">
                        <a href="{{route('admin.transaction.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                            <span class="nk-menu-text">Đặt hàng</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
