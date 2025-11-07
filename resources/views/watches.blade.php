<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <meta name="robots" content="index, follow" />
    <meta name="keywords"
        content="Hayek Gaming, Hayek Gaming Ground, Watches Lebanon, Smart Watches Lebanon, Digital Watches, Gold Watches, Silver Watches, Luxury Watches, Electronic Gadgets, Accessories, Fashion Tech, Gifts Lebanon" />
    <meta name="author" content="Hayek Gaming Ground" />
    <meta name="copyright" content="Copyright © 2024 HayekGaming" />
    <meta name="theme-color" content="#2a2670" />
    <meta name="description"
        content="Explore Hayek Gaming's exclusive collection of watches in Lebanon — including digital, analog, smart, and luxury gold & silver watches. Shop with fast delivery and trusted quality." />

    <meta property="og:title" content="Watches | Hayek Gaming Ground" />
    <meta property="og:description"
        content="Discover premium watches at Hayek Gaming — digital, smart, and analog styles for gamers and professionals alike." />
    <meta property="og:image" content="https://www.hayekgaming.com/img/white-logo.svg" />
    <meta property="og:url" content="https://www.hayekgaming.com/watches" />
    <meta property="og:type" content="website" />
    {{-- End of SEO --}}

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <link rel="icon" sizes="32x32" href="/img/white-logo.svg">

    {{-- Shared Styles --}}
    <link rel="stylesheet" href="/css/navbar.css" />
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/productsList.css">
    <link rel="stylesheet" href="/css/productsPage.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/toast.css">

    {{-- Watches Page Style --}}
    <link rel="stylesheet" href="/css/watches.css">

    <title>Watches | Hayek Gaming Ground</title>
</head>

<body class="watches-page">
    {{-- Navbar --}}
    <x-navbar :categories="$categories" cartQuantity="{{ $cartQuantity }}" />

    {{-- Main Content --}}
    <section class="productsPage">
        <div class="path">
            <h3>Home > <span style="color:black;">{{$path}}</span></h3>
        </div>


        <section class="productsList">
            @foreach ($watches as $watch)
            <x-watch-card title="{{ $watch->name }}" price="{{ $watch->price }}" salePrice="{{ $watch->sale }}"
                type="{{ $watch->type->name }}" id="{{ $watch->id }}" isAvailable="{{ $watch->is_available }}"
                image="{{ $watch->image }}" image1="{{ $watch->image1 }}" image2="{{ $watch->image2 }}"
                image3="{{ $watch->image3 }}" image4="{{ $watch->image4 }}" image5="{{ $watch->image5 }}"
                image6="{{ $watch->image6 }}" color="{{ $watch->color }}" color1="{{ $watch->color1 }}"
                color2="{{ $watch->color2 }}" color3="{{ $watch->color3 }}" color4="{{ $watch->color4 }}"
                color5="{{ $watch->color5 }}" color6="{{ $watch->color6 }}" />
            @endforeach
        </section>
    </section>

    {{-- Toast notification --}}
    <div id="toast" class="toast"></div>

    {{-- Footer --}}
    <x-footer :categories="$categories" movingSentence="{{ $movingSentence }}" />

    {{-- Scripts --}}
    <script src="/js/navbar.js"></script>
    <script src="/js/order.js"></script>
    <script>
        function changeWatchImage(dot, id) {
    const newImg = dot.getAttribute('data-img');
    const card = dot.closest('.product-card');
    const imgElement = card.querySelector('img');
    
    // Change main image
    imgElement.src = newImg;

    // Highlight active color
    const allDots = card.querySelectorAll('.color-dot');
    allDots.forEach(d => d.classList.remove('active-dot'));
    dot.classList.add('active-dot');
}
    </script>

</body>

</html>