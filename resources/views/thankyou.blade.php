<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hayek Gaming Ground</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="32x32" href="/img/white-logo.webp">
        <link rel="stylesheet" href="/css/navbar.css" />
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/thankyou.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
    <link rel="stylesheet" href="/css/thankyou.css">

</head>
<body>
    <x-navbar 
    :categories="$categories"
    cartQuantity="{{$cartQuantity}}"
    />
    <section class="thankyou-wrapper">
    <div class="thank-you-container">
        <div class="thank-you-message">
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been successfully placed. We appreciate your business and will begin processing your order right away.</p>
            <p><strong>Estimated Delivery: 5-7 business days</strong></p>
            <p>If you have any questions about your order, feel free to <a href="https://wa.me/96178904703" target="_blank">contact us</a>.</p>
            <a href="/" class="home-button">Return to Homepage</a>
        </div>
    </div>
</section>
<x-footer :categories="$categories"/>
<script src="/js/navbar.js"></script>
</body>
</html>
