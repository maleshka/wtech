<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $selectedCategory?->name ?? 'Mens Protein' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/products-page.css">
    <link rel="stylesheet" href="/css/products_admin.css">
</head>
<body class="products-page">

<div class="page-shell">

    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="nav-left">
                        <a href="/" class="nav-link">Home</a>
                        <a href="/products/category/men" class="nav-link">Men</a>
                        <a href="/products/category/women" class="nav-link">Women</a>
                        <a href="/products/category/brands" class="nav-link">Brands</a>
                        <a href="/products/category/food" class="nav-link">Food</a>
                        <a href="/products/category/sports" class="nav-link">Sports</a>
                        <a href="/products/category/accessories" class="nav-link">Accessories</a>
                    </div>
                </div>

                <div class="nav-right">
                    <form method="GET" action="{{ route('products.search') }}" style="display:flex; align-items:center; gap:8px;">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search"
                            style="border:1px solid #ddd; padding:6px 10px; font-size:14px; width:140px;"
                        >
                        <button class="icon-btn" type="submit" aria-label="Search">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"></circle>
                                <path d="M20 20L16.65 16.65" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"></path>
                            </svg>
                        </button>
                    </form>

                    <a href="/cart" class="icon-btn active-icon" aria-label="Cart">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M8 8V6.5C8 4.57 9.57 3 11.5 3C13.43 3 15 4.57 15 6.5V8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            <path d="M5 8H18L17 19.5C16.93 20.37 16.2 21 15.33 21H7.67C6.8 21 6.07 20.37 6 19.5L5 8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    <button class="icon-btn" aria-label="Account">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.7"></circle>
                            <path d="M6.8 19.2C7.8 16.9 9.6 15.7 12 15.7C14.4 15.7 16.2 16.9 17.2 19.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"></path>
                        </svg>
                    </button>

                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="icon-btn" aria-label="Logout">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12H9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <main class="catalog-main">
        <div class="container-fluid custom-container">
            <div class="catalog-wrap">

<div class="title-row">
                    <h1 class="catalog-title">{{ $selectedCategory?->name ?? 'Mens Protein' }}</h1>
                    <span class="catalog-count">({{ $products->total() }})</span>
                    <a href="{{ route('admin.products.create') }}" class="admin-add-product-btn">+ Add new product</a>
                </div>

                <form method="GET" action="{{ url()->current() }}" id="filterForm">
                    <div class="filter-bar">
                        <details class="filter-dropdown">
                            <summary class="filter-btn newest-btn">Newest <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                <label class="filter-option">
                                    <input type="radio" name="sort" value="newest" {{ request('sort', 'newest') === 'newest' ? 'checked' : '' }}>
                                    <span>Newest First</span>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="sort" value="oldest" {{ request('sort') === 'oldest' ? 'checked' : '' }}>
                                    <span>Oldest First</span>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="sort" value="popular" {{ request('sort') === 'popular' ? 'checked' : '' }}>
                                    <span>Most Popular</span>
                                </label>
                            </div>
                        </details>

                        <details class="filter-dropdown">
                            <summary class="filter-btn">Price <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                <label class="filter-option">
                                    <input type="radio" name="sort" value="price_asc" {{ request('sort') === 'price_asc' ? 'checked' : '' }}>
                                    <span>Low to High</span>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="sort" value="price_desc" {{ request('sort') === 'price_desc' ? 'checked' : '' }}>
                                    <span>High to Low</span>
                                </label>
                                <div style="padding: 8px 14px 14px 14px;">
                                    <input type="number" name="price_min" placeholder="Min" value="{{ request('price_min') }}" class="form-control mb-2">
                                    <input type="number" name="price_max" placeholder="Max" value="{{ request('price_max') }}" class="form-control">
                                </div>
                            </div>
                        </details>

                        <details class="filter-dropdown">
                            <summary class="filter-btn">Size <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                @forelse($sizeOptions as $size)
                                    <label class="filter-option">
                                        <input type="checkbox" name="size[]" value="{{ $size }}" {{ in_array($size, request()->input('size', [])) ? 'checked' : '' }}>
                                        <span>{{ strtoupper($size) }}</span>
                                    </label>
                                @empty
                                    <label class="filter-option"><span>No sizes</span></label>
                                @endforelse
                            </div>
                        </details>

                        <details class="filter-dropdown">
                            <summary class="filter-btn">Sale <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                <label class="filter-option">
                                    <input type="checkbox" name="sale" value="on-sale" {{ request('sale') === 'on-sale' ? 'checked' : '' }}>
                                    <span>On Sale</span>
                                </label>
                            </div>
                        </details>

                        <details class="filter-dropdown">
                            <summary class="filter-btn">Brand <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                @forelse($brandOptions as $brand)
                                    <label class="filter-option">
                                        <input type="checkbox" name="brand[]" value="{{ $brand }}" {{ in_array($brand, request()->input('brand', [])) ? 'checked' : '' }}>
                                        <span>{{ $brand }}</span>
                                    </label>
                                @empty
                                    <label class="filter-option"><span>No brands</span></label>
                                @endforelse
                            </div>
                        </details>

                        <details class="filter-dropdown">
                            <summary class="filter-btn">Color <span>▼</span></summary>
                            <div class="filter-dropdown-menu">
                                @forelse($colorOptions as $color)
                                    <label class="filter-option">
                                        <input type="checkbox" name="color[]" value="{{ $color }}" {{ in_array($color, request()->input('color', [])) ? 'checked' : '' }}>
                                        <span>{{ ucfirst($color) }}</span>
                                    </label>
                                @empty
                                    <label class="filter-option"><span>No colors</span></label>
                                @endforelse
                            </div>
                        </details>
                    </div>
                </form>

                <section class="products-grid">
                    @forelse($products as $product)
                        <article class="product-card-custom admin-card">
                            <a href="{{ route('products.show', $product) }}" class="product-card-link">
                                <div class="product-thumb">
                                    <img src="{{ $product->image ? asset($product->image) : '/photo/protein_moc.webp' }}" alt="{{ $product->name }}">
                                </div>
                                <h3 class="product-name">{{ $product->name }}</h3>
                            </a>
                            <div class="product-price-row">
                                <div class="price-wrap">
                                    <span class="price-new">$ {{ number_format($product->price, 2) }}</span>
                                    @if($product->old_price)
                                        <span class="price-old">$ {{ number_format($product->old_price, 2) }}</span>
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="admin-delete-btn" type="submit">Delete</button>
                                </form>
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-edit-btn">Edit</a>
                            </div>
                        </article>
                    @empty
                        <div style="padding:40px 0;">No products found.</div>
                    @endforelse
                </section>

                <div class="pagination-wrap">
                    <div class="pagination-line"></div>

                    @if ($products->lastPage() > 1)
                        <nav class="catalog-pagination">

                            @if ($products->onFirstPage())
                                <span class="page-nav disabled">&lt; Previous</span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="page-nav">&lt; Previous</a>
                            @endif

                            @php
                                $current = $products->currentPage();
                                $last = $products->lastPage();
                                $pages = [];
                                if ($last <= 7) {
                                    $pages = range(1, $last);
                                } else {
                                    if ($current <= 3) {
                                        $pages = [1, 2, 3, '...', $last];
                                    } elseif ($current >= $last - 2) {
                                        $pages = [1, '...', $last - 2, $last - 1, $last];
                                    } else {
                                        $pages = [1, '...', $current - 1, $current, $current + 1, '...', $last];
                                    }
                                }
                            @endphp

                            @foreach ($pages as $page)
                                @if ($page === '...')
                                    <span class="page-dots">...</span>
                                @elseif ($page == $current)
                                    <span class="page-num active">{{ $page }}</span>
                                @else
                                    <a href="{{ $products->url($page) }}" class="page-num">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="page-nav next">Next &gt;</a>
                            @else
                                <span class="page-nav next disabled">Next &gt;</span>
                            @endif

                        </nav>
                    @endif
                </div>

            </div>
        </div>
    </main>

</div>

<script src="/js/filter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('filterForm');
        if (!form) return;

        const autoSubmitInputs = form.querySelectorAll(
            'input[type="radio"], input[type="checkbox"]'
        );

        autoSubmitInputs.forEach(input => {
            input.addEventListener('change', function () {
                form.submit();
            });
        });

        const priceInputs = form.querySelectorAll(
            'input[name="price_min"], input[name="price_max"]'
        );

        priceInputs.forEach(input => {
            input.addEventListener('change', function () {
                form.submit();
            });
        });
    });
</script>
</body>
</html>
