<div class="related-products">
    <h2>
        @if($title==="Games")
        <a href='/allGames/{{$subId}}'>
            {!! $title !!}
        </a>
        @else
        @if($hasSubCategory)
        <a href="{{ $isGames ? '/products/'.$subId.'/' . $gameTypeId  : '/products/category/' . $subId }}">
            {!! $title !!}
        </a>
        @else
        <a href="{{ '/products/'.$subId}}">
            {!! $title !!}
        </a>
        @endif
        @endif
    </h2>
    <div class="products">
        @foreach ($products as $product)
        <x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
            salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}"
            isAvailable="{{$product->is_available}}" />
        @endforeach

    </div>
</div>