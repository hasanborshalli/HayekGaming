<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" sizes="32x32" href="/img/white-logo.svg">
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/productsManage.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <title>Manage Watches</title>
</head>

<body>
    @if (session('message'))
    <div id="toast" class="toast">{{ session('message') }}</div>
    <script>
        // Show toast for 3 seconds then fade out
        window.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        });
    </script>
    @endif
    <x-navigator />
    <section class="manageProducts-page">
        <h1 class="page-title">Manage Watches & Bracelets</h1>
        <div class="add-btn">
            <button onclick="window.location.href='/admin/watches/add'">+ Add Watch Or Bracelet</button>
            <form action="/admin/search/watches" method="GET">
                <input type="text" id="searchInput" placeholder="Search watches and bracelets..." name="search">
            </form>
        </div>

        <div class="product-grid" id="productGrid">
            @foreach ($watches as $watch)
            <x-admin-watch-card name="{{$watch->name}}" type="{{$watch->type->name}}" price="{{$watch->price}}"
                cost="{{number_format($watch->cost, 0)}}" id="{{$watch->id}}" color="{{ $watch->color }} "
                color1="{{ $watch->color1 }} " color2="{{ $watch->color2 }} " color3="{{ $watch->color3 }} "
                color4="{{ $watch->color4 }} " color5="{{ $watch->color5 }} " color6="{{ $watch->color6 }} " />

            @endforeach
        </div>
        <div id="delete-toast" class="delete-toast"></div>
        <div id="confirmOverlay" class="overlay" style="display: none;">
            <div class="confirm-box">
                <p id="confirmation-message"></p>
                <div class="buttons">
                    <button class="btn red" id="confirmYes">Yes</button>
                    <button class="btn" id="confirmNo">No</button>
                </div>
            </div>
        </div>
        {{ $watches->appends(request()->query())->links() }}
    </section>

    <script src="/js/productsManage.js">

    </script>
</body>

</html>