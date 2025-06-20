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
  <title>Manage Products</title>
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
    <h1 class="page-title">Manage Products</h1>
    <div class="add-btn">
      <button onclick="window.location.href='/admin/products/add'">+ Add Product</button>
      <form action="/admin/search/products" method="GET">
        <input type="text" id="searchInput" placeholder="Search products..." name="search">
      </form>
    </div>
    <form action="/admin/filterProducts" method="GET" id="filterForm">
      <div class="filter-bar">
        <div class="filter-group">
          <label for="categoryFilter">Category:</label>
          <select name="category_id" id="categoryFilter">
            <option value="0">All Categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="filter-group">
          <label for="subcategoryFilter">Subcategory:</label>
          <select name="subcategory_id" id="subcategoryFilter">
            <option value="0">All Subcategories</option>
          </select>
        </div>

        <div class="filter-group" id="gameTypeCheckboxes" style="display:none;">
          <label>Game Types:</label>
          <div class="checkbox-group">
            @foreach ($gameTypes as $gameType)
            <label class="checkbox-item">
              <input type="checkbox" name="gameTypes[]" value="{{ $gameType->name }}">
              {{ $gameType->name }}
            </label>
            @endforeach
          </div>
        </div>

        <div class="filter-group">
          <input type="submit" value="Apply Filter" class="filter-btn">
        </div>

      </div>
    </form>
    <div class="product-grid" id="productGrid">
      @foreach ($products as $product)
      <x-admin-product-card name="{{$product->name}}" category="{{$product->category->slogan}}"
        subCategory="{{$product->subCategory->name}}" gameType="{{$product->gameType}}" price="{{$product->price}}"
        id="{{$product->id}}" />

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
    {{ $products->links() }}
  </section>

  <script src="/js/productsManage.js">

  </script>
</body>

</html>