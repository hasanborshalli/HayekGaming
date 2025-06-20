<div class="product-card">
    <div class="card-image">
        <a href="/product/{{$id}}">
            <img src="/storage/products/{{$image}}" alt="{{ html_entity_decode($title) }}" loading="lazy">
        </a>
        @if($salePrice)
        <div class="sale-badge">SALE</div>
        @endif
    </div>

    <div class="card-details">
        <div class="card-category-price">
            <span class="product-category">{{ html_entity_decode($category) }}</span>
            @if($salePrice)
            <div class="product-price">
                <span class="old-price">${{ number_format($price, 2) }}</span>
                <span class="sale-price">${{ number_format($salePrice, 2) }}</span>
            </div>
            @else
            <div class="product-price">
                <span>${{ number_format($price, 2) }}</span>
            </div>
            @endif
        </div>

        <div class="product-title">
            <p>{{ html_entity_decode($title) }}</p>
        </div>

        <button class="add-to-cart-btn" onclick="addToCart({{ $id }})">
            Add to cart
            <img src="/img/colored-cart.svg" class="cart-icon" />
        </button>
    </div>
</div>