<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="icon" sizes="32x32" href="/img/white-logo.svg">
    <link rel="stylesheet" href="/css/navbar.css" />
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/productsList.css">
    <link rel="stylesheet" href="/css/productsPage.css">
    <link rel="stylesheet" href="/css/relatedProducts.css">
    <link rel="stylesheet" href="/css/pagination.css">

    <title>Products Page</title>
    <style>
        .product-card,
        .product-category,
        .product-title p {
            color: black !important;
        }
    </style>
</head>

<body>
    <x-navbar :categories="$categories" cartQuantity="{{$cartQuantity}}" />
    <section class="productsPage">
        <div class="path">
            @if ($isGameType)
            <h3><a href="/">Home </a>> <a
                    href="/products/{{$subCategory->category->id}}">{{$subCategory->category->name}}</a> > <a
                    href="/products/category/{{$subCategory->id}}">{{$subCategory->name}}</a> > <span
                    style="color:rgb(0,0,0);">{{$gameType->name}} </span></h3>
            @else
            <h3><a href="/">Home </a>> <a
                    href="/products/{{$subCategory->category->id}}">{{$subCategory->category->name}}</a> > <span
                    style="color:rgb(0,0,0);">{{$subCategory->name}} </span></h3>
            @endif
        </div>
        @if ($subCategory->name=='Games')
        @if (!$isGameType)
        <!-- Sticky Filter Button -->
        <button class="filter-toggle-btn" onclick="toggleFilterForm()">Filter</button>

        <!-- Hidden Filter Form -->
        <div id="filterFormContainer" class="filter-form-popup">
            <form method="GET" action="/filterProducts" class="gameType-filter-form">
                <h4>Filter by Game Types:</h4>
                <input type="hidden" name="subCategoryId" value="{{ $subCategory->id }}">
                <div class="gameTypes">
                    @foreach ($gameTypes as $gameType)
                    <label>
                        <input type="checkbox" name="gameTypes[]" value="{{ $gameType->id }}">
                        {{ $gameType->name }}
                    </label><br>
                    @endforeach
                </div>
                <button type="submit">Apply Filter</button>
            </form>
        </div>

        <x-related-products :products="$subCategory->products->take(5)" title="All Games" subId="{{$gameType->id}}"
            category="{{$subCategory->category->id}}" isGames="{{true}}" />

        @foreach ($gameTypes as $gameType)
        <x-related-products :products="$gameType->products->take(5)" title="{{$gameType->name}}"
            subId="{{$gameType->id}}" category="{{$subCategory->category->id}}" isGames="{{true}}" />
        @endforeach
        @else
        <section class="productsList">
            @foreach ($products as $product)
            <x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
                salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />

            @endforeach
        </section>
        {{ $products->links() }}
        @endif

        @else
        <h3>{{$subCategory->name}}</h3>
        <section class="productsList">
            @foreach ($subCategory->products as $product)
            <x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
                salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />

            @endforeach
        </section>
        @endif


    </section>
    <x-footer :categories="$categories" />
    <script src="/js/navbar.js"></script>
    <script>
        function toggleFilterForm() {
        const popup = document.getElementById('filterFormContainer');
        popup.classList.toggle('show');
    }
    </script>
</body>

</html>