<div class="product-card {{$salePrice ? 'sales' : ''}} {{$isAvailable ? '' : 'notAvailable'}}">
    <div class="card-image position-relative">
        <a href="/watch/{{$id}}" class="image-wrapper {{ !$isAvailable ? 'unavailable' : '' }}">
            <img src="/storage/watches/{{$image}}" alt="{{ html_entity_decode($title) }}" loading="lazy">
        </a>
        {{-- Color Dots --}}
        @php
        $colorList = [
        ['hex' => $color ?? null, 'img' => $image ?? null],
        ['hex' => $color1 ?? null, 'img' => $image1 ?? null],
        ['hex' => $color2 ?? null, 'img' => $image2 ?? null],
        ['hex' => $color3 ?? null, 'img' => $image3 ?? null],
        ['hex' => $color4 ?? null, 'img' => $image4 ?? null],
        ['hex' => $color5 ?? null, 'img' => $image5 ?? null],
        ['hex' => $color6 ?? null, 'img' => $image6 ?? null],
        ];

        $colorList = array_filter($colorList, fn($item) => !empty($item['hex']) && !empty($item['img']));
        @endphp



        @if($salePrice && $isAvailable)
        <div class="sale-badge">SALE</div>
        @endif

        @unless($isAvailable)
        <div class="sold-out-overlay">SOLD OUT</div>
        @endunless
    </div>

    @if(count($colorList) > 0)
    <div class="color-dots-container">
        @foreach($colorList as $index => $item)
        <span class="color-dot {{ $loop->first ? 'active-dot' : '' }}" style="background-color: {{ $item['hex'] }};"
            data-img="/storage/watches/{{ $item['img'] }}" title="{{ $item['hex'] }}"
            onclick="changeWatchImage(this, '{{ $id }}')"></span>
        @endforeach
    </div>
    @endif
    <div class="card-details">
        <div class="card-category-price">
            <span class="product-category">{{ html_entity_decode($type) }}</span>
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

        @if($isAvailable)
        <button class="add-to-cart-btn {{$salePrice ? 'sales-add-to-cart-btn' : ''}}"
            onclick="addToCart({{ $id }},'watch')">
            Add to cart
            <img src="/img/black-cart.svg" class="cart-icon" />

        </button>
        @else
        <button class="add-to-cart-btn sold-out-btn " disabled>
            Sold Out
        </button>
        @endif
    </div>
</div>