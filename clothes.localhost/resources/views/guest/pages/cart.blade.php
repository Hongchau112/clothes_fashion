@if(Session::has('cart') != null)
    @foreach(Session::get('cart')->products as $product)
        {{$product['product']->name}}
        {{$product['product']->id}}
        {{$product['quanty']}}
    @endforeach
    {{Session::get('cart')->total_quanty}}
@endif
