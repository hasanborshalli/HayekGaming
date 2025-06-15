<!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-close" id="sidebarClose">×</div>
    <ul class="sidebar-menu">
        <li><a href="/">Home</a></li>
        @foreach ($categories as $category)
        @if ($category->subcategories->count()>0)
        <li class="sidebar-dropdown">
            <div class="sidebar-toggle">{{$category->name}} <span class="arrow">˅</span></div>
            <div class="sidebar-submenu">
                <ul>
                    @foreach ($category->subcategories as $subcategory)
                    <a href="/products/category/{{$subcategory->id}}">
                        <li>{{$subcategory->name}}</li>
                    </a>
                    @endforeach
                </ul>
                <img src="/img/{{$category->slogan}}.webp" alt="{{$category->slogan}}" class="sidebar-image"
                    loading="lazy" />
            </div>
        </li>
        @else
        <li><a href="/products/{{$category->id}}">{{$category->name}}</a></li>
        @endif

        @endforeach

    </ul>
</div>