<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" sizes="32x32" href="/img/white-logo.png">
        <link rel="stylesheet" href="/css/navbar.css" />
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/checkout.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <title>Checkout</title>

</head>
<body>
    <x-navbar 
    :categories="$categories"
    cartQuantity="{{$cartQuantity}}"
    />
            <section class="checkout-wrapper">
    <div class="checkout-container">
        <h2>Checkout Form</h2>
        <form action="/order" method="POST" class="checkout-form">
            @csrf
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="name" required placeholder="Enter your full name" value="{{old('name')}}">
                @error('name')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="mobile" required placeholder="Enter your mobile number" value="{{old('mobile')}}">
                @error('mobile')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required placeholder="Enter your city" value="{{old('city')}}">
                @error('city')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" id="street" name="street" required placeholder="Enter your street name" value="{{old('street')}}">
                @error('street')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="building">Building</label>
                <input type="text" id="building" name="building" placeholder="Enter your building (optional)" value="{{old('building')}}">
                @error('building')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="floor">Floor</label>
                <input type="text" id="floor" name="floor" placeholder="Enter your floor (optional)" value="{{old('floor')}}">
                @error('floor')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" placeholder="Enter any remarks (optional)">{{old('remarks')}}</textarea>
                @error('remarks')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="submit-btn">Send Order</button>
        </form>
    </div>
</section>
    <x-footer :categories="$categories"/>
    <script src="/js/navbar.js"></script>
</body>