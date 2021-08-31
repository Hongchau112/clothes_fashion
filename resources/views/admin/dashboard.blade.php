<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    @include('admin.layout.head')
    @stack('head')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        @include('admin.layout.sidebar')
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('admin.layout.header')
            <!-- main header @e -->
            <!-- content @s -->
            @yield('main')
            <!-- content @e -->
            <!-- footer @s -->
            @include('admin.layout.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src={{asset("/dashlite/assets/js/bundle.js?ver=2.5.0")}}></script>
<script src={{asset("/dashlite/assets/js/scripts.js?ver=2.5.0")}}></script>
<script src={{asset("/dashlite/assets/js/charts/gd-default.js?ver=2.5.0")}}></script>
</body>

</html>
