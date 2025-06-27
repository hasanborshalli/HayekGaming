<div class="product-box">
    <div class="product-images">
        <div class="other-images"> {{-- Image 400px x 400px --}}
            <img src="/storage/products/{{$image}}" alt="" id="img" class="selected-image"
                onclick="changeImage('img','/storage/products/{{$image}}')" loading="lazy">
            @if($image1)
            <img src="/storage/products/{{$image1}}" alt="" id="img1"
                onclick="changeImage('img1','/storage/products/{{$image1}}')" loading="lazy">
            @endif
            @if($image2)
            <img src="/storage/products/{{$image2}}" alt="" id="img2"
                onclick="changeImage('img2','/storage/products/{{$image2}}')" loading="lazy">
            @endif
            @if($image3)
            <img src="/storage/products/{{$image3}}" alt="" id="img3"
                onclick="changeImage('img3','/storage/products/{{$image3}}')" loading="lazy">
            @endif
            @if($image4)
            <img src="/storage/products/{{$image4}}" alt="" id="img4"
                onclick="changeImage('img4','/storage/products/{{$image4}}')" loading="lazy">
            @endif
            @if($image5)
            <img src="/storage/products/{{$image5}}" alt="" id="img5"
                onclick="changeImage('img5','/storage/products/{{$image5}}')" loading="lazy">
            @endif
            @if($image6)
            <img src="/storage/products/{{$image6}}" alt="" id="img6"
                onclick="changeImage('img6','/storage/products/{{$image6}}')" loading="lazy">
            @endif
        </div>
        <div class="product-img"><img src="/storage/products/{{$image}}" alt="" loading="lazy"></div>{{-- Image 400px x
        400px --}}
    </div>
    <div class="product-detail">
        <div class="product-detail-list">
            <div>{{html_entity_decode($name)}} </div>
            <div class="product-price-section">
                Price:
                @if($sale)
                <span class="price sale-price">${{ number_format($sale, 2) }}</span>
                <span class="original-price strikethrough">${{ number_format($price, 2) }}</span>
                <span class="sale-badge-box">SALE</span>
                @else
                <span class="price">${{ number_format($price, 2) }}</span>
                @endif
            </div>
            <div class="quantity">Quantity: <div class="quantity-btns"><button
                        onclick="updateQuantity('-')">-</button><input id="quantity-{{$id}}" class="quantity-input"
                        name="quantity" value="1" min="1"><button onclick="updateQuantity('+')">+</button></div>
            </div>
            <div class="order-btns">
                <button class="add-cart" onclick="addToCart({{$id}})">Add to cart</button>
                <form id="buyNowForm" action="/addCart/true" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="quantity" id="buyNowQuantity" value="1">
                    <button type="submit" class="buy-now" onclick="syncQuantity()">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function syncQuantity() {
        const selectedQty = document.getElementById('quantity').value;
        document.getElementById('buyNowQuantity').value = selectedQty;
    }
</script>