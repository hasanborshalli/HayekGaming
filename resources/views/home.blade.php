<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />

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

	<link rel="icon" sizes="32x32" href="/img/white-logo.svg">
	<link rel="stylesheet" href="/css/navbar.css" />
	<link rel="stylesheet" href="/css/home.css" />
	<link rel="stylesheet" href="/css/carousel.css">
	<link rel="stylesheet" href="/css/footer.css">
	<link rel="stylesheet" href="/css/sidebar.css">
	<link rel="stylesheet" href="/css/productsList.css">
	<link rel="stylesheet" href="/css/toast.css">
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap&family=Archivo+Black&family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet" />
	<title>Hayek Gaming Ground</title>
</head>

<body>
	<x-navbar :categories="$categories" cartQuantity="{{$cartQuantity}}" />
	<div class="whole-carousel">
		<div class="carousel-left">
			@php
			$prevIndex = ($activeIndex - 1 + $banners->count()) % $banners->count();
			$prevBanner = $banners[$prevIndex];
			@endphp
			<img src="/storage/banners/{{$prevBanner->image}}" alt="" id="prevBanner">
		</div>
		<section class="carousel-wrapper">
			<div class="carousel-container">
				<div class="carousel-track">
					@foreach ($banners as $banner)
					<x-image-container image="{{ $banner->image }}" mobile-image="{{ $banner->mobile_image }}"
						small-image="{{ $banner->small_image }}" id="{{ $banner->product->id }}" />
					@endforeach
				</div>

			</div>
			<div class="carousel-dots">
				<span class="dot active"></span>
				@for ($i=0;$i<$banners->count()-1;$i++)
					<span class="dot"></span>
					@endfor
			</div>
		</section>
		<div class="carousel-right">
			@php
			$nextIndex = ($activeIndex + 1) % $banners->count();
			$nextBanner = $banners[$nextIndex];
			@endphp
			<img src="/storage/banners/{{$nextBanner->image}}" alt="" id="nextBanner">
		</div>
	</div>
	<section class="boxes-container">
		<div class="boxes">
			<x-category-box image="/storage/comingSoon/{{$comingSoon->image}}" title="Coming Soon"
				path="/coming-soon" />
			<x-category-box image="/img/ps.webp" title="Playstation" path="/products/1" />
			<x-category-box image="/img/retro.webp" title="Retro" path="/products/7" />
			<x-category-box image="/img/Setup.webp" title="Gaming Setup" path="/products/5" />
		</div>
	</section>
	<section class="new">
		<div class="shadow"></div>
		<div class="section-title">
			<h1>PS5 New Products</h1>
			<div class="products">
				@foreach ($newproducts as $product)
				<x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
					salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />
				@endforeach
			</div>
		</div>
	</section>
	<section class="featured">
		<div class="shadow"></div>

		<div class="section-title">
			<h1>Featured Products</h1>
			<div class="products">
				@foreach ($featuredProducts as $product)
				<x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
					salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />
				@endforeach
			</div>
		</div>
	</section>
	<section class="ps5-controllers">
		<div class="header">
			<h2>PS5 Controllers</h2>
			<button class="view-all" onclick="window.location.href='/products/category/5'">View All</button>
		</div>
		<div class="controller-carousel">
			@foreach($controllers as $controller)
			<div class="controller-card">
				<a href="/product/{{$controller->id}}" style="text-decoration: none">
					<div class="controller-image-wrapper">
						<img src="/storage/products/{{$controller->image}}"
							alt="{{ html_entity_decode($controller->name) }}" loading="lazy" class="controller-img" />
						@if($controller->sale)
						<div class="sale-badge">SALE</div>
						@endif
					</div>
					<div class="controller-info-container">
						<h3 style="color:black">{{ html_entity_decode($controller->name) }}</h3>
					</div>

					@if($controller->sale)
					<div class="product-price">
						<span class="old-price">${{ number_format($controller->price, 2) }}</span>
						<span class="sale-price">${{ number_format($controller->sale, 2) }}</span>
					</div>
					@else
					<p class="price">${{ number_format($controller->price, 2) }}</p>
					@endif

					<button onclick="addToCart({{ $controller->id }})" style="font-family: 'Poppins', sans-serif;">
						Add to cart
						<img src="/img/colored-cart.svg" class="cart-icon" />
					</button>
				</a>
			</div>

			@endforeach
		</div>
	</section>

	<section class="info">
		<div class="general-info">
			<ul>
				<li>🛒 Hadath Beirut, Hayek Gaming Ground</li>
				<li>🚚 Delivery all over Lebanon</li>
				<li>⏱️ <span class="open">Currently Open</span> <span style="color:red">Close at 7:00 PM</span></li>
			</ul>
		</div>
		<div class="map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d106045.32744561206!2d35.447177911202736!3d33.84026439283012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x151f190dacbe9df3%3A0x4a0513f5fbc00c9f!2shttps%3A%2F%2Fmaps.app.goo.gl%2F2wUnruz8XEdamk8DA%2C%20Hadath%200000!3m2!1d33.840291799999996!2d35.5295791!5e0!3m2!1sen!2slb!4v1746635875629!5m2!1sen!2slb"
				height="380" style="border:0;" allowfullscreen="" loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>


	<x-footer :categories="$categories" movingSentence="{{$movingSentence}}" />
	<div id="toast" class="toast"></div>
	<script src="/js/home.js"></script>
	<script src="/js/navbar.js"></script>
	<script src="/js/order.js"></script>
</body>

</html>