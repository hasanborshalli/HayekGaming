<div class="product">
    <a href="/product/{{$id}}"><img src="/storage/products/{{$image}}" alt="{{html_entity_decode($title)}}" loading="lazy"></a>
    <div class="product-category">
        <h3>{{html_entity_decode($category)}}</h3>
        <h3>{{$price}}$</h3>
    </div>
    <div class="product-title">
        <p>{{html_entity_decode($title)}}</p>
    </div>
    <div class="product-btn"><button onclick="addToCart({{$id}})">Add to cart</button></div>
</div>