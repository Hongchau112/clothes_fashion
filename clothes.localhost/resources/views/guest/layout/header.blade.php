<header>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <img class="navbar-brand" src="{{asset('mystore/img/logo.png')}}">
{{--            <button class="navbar-toggler" type="button" data-toggle="collapse"--}}
{{--                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"--}}
{{--                    aria-label="Toggle navigation">--}}
{{--                <i class="fa fa-bars"></i>--}}
{{--            </button>--}}





            <div class="navbar-center collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav navbar-left" >
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('guest.index')}}">Trang chủ </a>
                    </li>
                    @php
                        $count=0;
                    @endphp

                    @foreach($categories as $i => $cate)
                        @if($cate->parent_category_id==0)
                            @php
                                $count=$count+1;
                            @endphp
                        @endif

                        @if($count < 6)
                            @if($cate->parent_category_id==0)
                                <li class="nav-item dropdown">
                                    @php
                                        $flag = 0;
                                    @endphp
                                    @foreach($categories as $cate3)
                                        @if($cate3->parent_category_id==$cate->id)
                                            @php
                                                $flag = 1
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if($flag==1)
                                        <a class="nav-link dropdown-toggle"  href="">{{$cate->name}}</a>

                                    @else
                                        <a class="nav-link" href="">{{$cate->name}}</a>
                                    @endif
                                    <div class="dropdown-menu" style="padding: 0px; ">
                                        @foreach($categories as $cate2)
                                            @if($cate2->parent_category_id==$cate->id)
                                                <a class="nav-link" href="">{{$cate2->name}}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach

                </ul>
                <div class="navbar-right">
                    <div id="search-bar">
                        <i id='toggle-search' class="fa fa-search"></i>
                        <input style='display:none;' id='searchBar' name='search' type='search' placeholder='Search'>
                    </div>
                </div>
                <div id="shopping-cart">
                    <a href="{{route('guest.show_cart')}}"><i class="fa fa-shopping-cart"></i></a>
                    <span id="cart">@if(Session::has('cart')!=null){{Session::get('cart')->total_quanty}} @else 0 @endif</span>
                </div>
            </div>
        </div>
    </nav>
</header>

@push('footer')
    <script>
        $('#toggle-search').on('click', function() {
            $('#searchBar').toggle('display: inline-block');
        });
    </script>
@endpush

