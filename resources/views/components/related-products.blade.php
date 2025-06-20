<div class="related-products">
    <h2>
        <a href="{{ $isGames ? '/products/'.$category.'/' . $subId  : '/products/category/' . $subId }}">
            {!! $title !!}
        </a>
    </h2>
    <div class="products">
        @foreach ($products as $product)
        <x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
            salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />


        @endforeach

    </div>
</div>