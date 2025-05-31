<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="icon" sizes="32x32" href="/img/white-logo.png">
        <link rel="stylesheet" href="/css/navbar.css" />
        <link rel="stylesheet" href="/css/home.css" />
        <link rel="stylesheet" href="/css/carousel.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/productsList.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <title>Hayek Gaming Ground</title>
    </head>
    <body>
        <x-navbar />
        <section class="carousel-wrapper">
            <div class="carousel-container">
               <x-image-container/>
               <x-image-container/>
               <x-image-container/>
            </div>
            <div class="carousel-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </section>
        <section class="boxes-container">
        <div class="boxes">
            <x-category-box
            image="coming.jpeg"
            title="Coming Soon"/>
            <x-category-box
            image="ps.jpg"
            title="Playstation"/>
            <x-category-box
            image="retro.jpg"
            title="Retro"/>
            <x-category-box
            image="setup.jpg"
            title="Gaming Setup"/>
          </div>
        </section>
        <section class="new">
            <div class="shadow"></div>
            <div class="section-title">
                <h1>New Products</h1>
                <div class="products">
                    <x-new-product-card
                    image="banner2.png"
                    title="EA SPORTS FC 25 STANDARD EDITION"
                    price="35.00"
                    category="PS5"
                    />
                    
                    
                </div>
            </div>
        </section>
        <section class="featured">
            <div class="shadow"></div>

            <div class="section-title">
                <h1>Featured Products</h1>
                <div class="products">
                    <x-new-product-card
                    image="banner2.png"
                    title="EA SPORTS FC 25 STANDARD EDITION"
                    price="35.00"
                    category="PS5"
                    />
                   
                    
                </div>
            </div>
        </section>
        <section class="controllers">
            <div class="controller-card"><img src="/img/ps5-controller.png" alt=""><h5>Playstation 5 Controllers</h5></div>
            <div class="controller-card"><img src="/img/ps4-controller.png" alt=""><h5>Playstation 4 Controllers</h5></div>
            <div class="controller-card"><img src="/img/nswitch.png" alt=""><h5>N-switch Controllers</h5></div>
        </section>
        <section class="info">
            <div class="general-info">
                <ul>
                    <li>🛒 Hadath Beirut, Hayek Gaming Ground</li>
                    <li>🚚 Delivery all over Lebanon</li>
                    <li>⏱️ <span class="open">Currently Open</span> <span style="color:red">Close at 6:00 PM</span></li>
                </ul>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d106045.32744561206!2d35.447177911202736!3d33.84026439283012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x151f190dacbe9df3%3A0x4a0513f5fbc00c9f!2shttps%3A%2F%2Fmaps.app.goo.gl%2F2wUnruz8XEdamk8DA%2C%20Hadath%200000!3m2!1d33.840291799999996!2d35.5295791!5e0!3m2!1sen!2slb!4v1746635875629!5m2!1sen!2slb"  height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
        <x-footer/>
        <script src="/js/home.js"></script>
    </body>
</html>
