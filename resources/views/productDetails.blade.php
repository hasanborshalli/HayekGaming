<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
                <link rel="icon" sizes="32x32" href="/img/white-logo.png">

            <link rel="stylesheet" href="/css/navbar.css" />
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/productDetails.css">
        <link rel="stylesheet" href="/css/relatedProducts.css">
        <link rel="stylesheet" href="/css/productsList.css">


    <title>Product Details</title>
</head>
<body>
    <x-navbar/>
    <section class="productDetailsPage">
    <div class="path">
        <h3>Home > Playstation 5 > <span style="color:rgba(0,0,0,1);">Consoles</span></h3>
    </div>
    <x-product-box/>
    <x-product-description/>
    <x-related-products/>
    </section>
    <x-footer/>
    <script src="/js/productDetails.js"></script>
</body>
</html>