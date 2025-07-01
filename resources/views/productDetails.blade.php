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
        content="Hayek Gaming,Hayek Gaming Ground, Gaming store Lebanon, Playstation Lebanon,Gaming accessories Lebanon, Gaming shop Beirut, Buy PS5 Lebanon, Gaming keyboards Lebanon, Nintendo Switch Lebanon, Retro, Electronics and gadgets, Gamer Setup" />
    <meta name="author" content="Hayek Gaming Ground" />
    <meta name="copyright" content="Copyright © 2024 HayekGaming" />
    <meta name="theme-color" content="#2a2670" />
    <meta name="description"
        content="Hayek Gaming is your ultimate destination in Lebanon for gaming consoles, accessories, and gear. Discover top deals on PlayStation 5, Playstation 4, Nintendo Switch, Gaming Setups, Electronic and gadgets, Retro and more with fast delivery and expert support all over lebanon." />

    <meta property="og:title" content="Hayek Gaming Ground" />
    <meta property="og:description"
        content="Hayek Gaming is your ultimate destination in Lebanon for gaming consoles, accessories, and gear. Discover top deals on PlayStation 5, Playstation 4, Nintendo Switch, Gaming Setups, Electronic and gadgets, Retro and more with fast delivery and expert support all over lebanon." />
    <meta property="og:image" content="https://www.hayekgaming.com/img/white-logo.svg" />
    <meta property="og:url" content="https://www.hayekgaming.com" />
    <meta property="og:type" content="website" />
    {{-- End of SEO --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="icon" sizes="32x32" href="/img/white-logo.svg">
    <link rel="stylesheet" href="/css/navbar.css" />
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/productDetails.css">
    <link rel="stylesheet" href="/css/relatedProducts.css">
    <link rel="stylesheet" href="/css/productsList.css">
    <link rel="stylesheet" href="/css/toast.css">
    <style>
        .product-card,
        .product-category,
        .product-title p {
            color: black !important;
        }
    </style>
    <title>Product Details</title>
</head>

<body>
    <x-navbar :categories="$categories" cartQuantity={{$cartQuantity}} />
    <section class="productDetailsPage">
        <div class="path">
            <h3>Home > <a
                    href="/products/{{ $product->category->id }}">{{html_entity_decode($product->category->name)}}</a> >
                <span style="color:rgba(0,0,0,1);">{{html_entity_decode($product->subCategory->name)}}</span>
            </h3>
        </div>
        <x-product-box name="{{$product->name}}" price="{{$product->price}}" id="{{$product->id}}"
            image="{{$product->image}}" image1="{{$product->image1}}" image2="{{$product->image2}}"
            image3="{{$product->image3}}" image4="{{$product->image4}}" image5="{{$product->image5}}"
            image6="{{$product->image6}}" sale="{{ $product->sale }}" />
        <x-product-description name="{{$product->name}}" description="{{$product->description}}"
            :boxContents="$boxContents" :features="$features" />
        <x-related-products :products="$relatedProducts" title="Related Products"
            isGames="{{ $product->subCategory->name == 'Games' ? true : false }}" subId="{{$product->sub_category_id}}"
            category="{{$product->category_id}}" gameTypeId="{{$product->gameTypes[0]->id ?? null}}" />
    </section>
    <x-footer :categories="$categories" />
    <div id="toast" class="toast"></div>
    <script src="/js/productDetails.js"></script>
    <script src="/js/navbar.js"></script>
    <script src="/js/order.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const description = document.getElementById('descriptionText');
        const toggleBtn = document.getElementById('toggleDescriptionBtn');

        toggleBtn.addEventListener('click', function () {
            description.classList.toggle('expanded');
            if (description.classList.contains('expanded')) {
                toggleBtn.textContent = 'View Less';
            } else {
                toggleBtn.textContent = 'View More';
            }
        });
    });
    </script>
</body>

</html>