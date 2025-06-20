<div class="product-box">
    <div class="product-images">
        <div class="other-images"> {{-- Image 400px x 400px --}}
            <img src="/storage/products/{{$image1}}" alt="" id="img1" class="selected-image"
                onclick="changeImage('img1','/storage/products/{{$image1}}')" loading="lazy">
            <img src="/storage/products/{{$image2}}" alt="" id="img2"
                onclick="changeImage('img2','/storage/products/{{$image2}}')" loading="lazy">
            <img src="/storage/products/{{$image3}}" alt="" id="img3"
                onclick="changeImage('img3','/storage/products/{{$image3}}')" loading="lazy">
            <img src="/storage/products/{{$image4}}" alt="" id="img4"
                onclick="changeImage('img4','/storage/products/{{$image4}}')" loading="lazy">
        </div>
        <div class="product-img"><img src="/storage/products/{{$image1}}" alt="" loading="lazy"></div>{{-- Image 400px x
        400px --}}
    </div>
    <div class="product-detail">
        <div class="product-detail-list">
            <div>{{html_entity_decode($name)}} </div>
            <div>Price: <span class="price">{{$price}}$</span></div>
            <div class="quantity">Quantity: <div class="quantity-btns"><button
                        onclick="updateQuantity('-')">-</button><input id="quantity" name="quantity" value="1"
                        min="1"><button onclick="updateQuantity('+')">+</button></div>
            </div>
            <div class="order-btns">
                <button class="add-cart" onclick="addToCart({{$id}})">Add to cart</button>
                <form id="buyNowForm" action="/addCart/true" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="quantity" id="buyNowQuantity" value="1">
                    <button type="submit" class="buy-now">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</div>