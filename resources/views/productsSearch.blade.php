<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="/css/toast.css">

    <title>Products Page</title>
</head>

<body>
    <x-navbar :categories="$categories" cartQuantity="{{$cartQuantity}}" />
    <section class="productsPage">
        <h3>You Searched for : <span style="color:red">{{$search}}</span></h3>
        @if($filter==true)
        <!-- Sticky Filter Button -->
        <button class="filter-toggle-btn" onclick="toggleFilterForm()">Filter</button>

        <!-- Hidden Filter Form -->
        <div id="filterFormContainer" class="filter-form-popup">
            <button type="button" class="close-filter-btn" onclick="toggleFilterForm()">×</button>
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
        @endif
        <section class="productsList">

            @foreach ($products as $product)
            <x-new-product-card image="{{$product->image}}" title="{{$product->name}}" price="{{$product->price}}"
                salePrice="{{$product->sale}}" category="{{$product->category->slogan}}" id="{{$product->id}}" />
            @endforeach
        </section>
        {{$products->appends(request()->query())->links()}}
    </section>
    <div id="toast" class="toast"></div>
    <x-footer :categories="$categories" />
    <script src="/js/navbar.js"></script>
    <script src="/js/order.js"></script>
    <script>
        function toggleFilterForm() {
        const popup = document.getElementById('filterFormContainer');
        popup.classList.toggle('show');
    }
    </script>
</body>

</html>