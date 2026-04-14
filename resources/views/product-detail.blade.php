<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->name }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/products_detail.css">
</head>
<body class="detail-page">

    <header class="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="nav-left">
            <a href="/" class="nav-link">Home</a>
            <a href="/products" class="nav-link">Men</a>
            <a href="#" class="nav-link">Women</a>
            <a href="#" class="nav-link">Brands</a>
            <a href="#" class="nav-link">Food</a>
            <a href="#" class="nav-link">Sports</a>
            <a href="#" class="nav-link">Accessories</a>
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

  <main class="detail-main">
    <div class="detail-container">

      <div class="detail-breadcrumb">
        Mens / Food / <span>{{ $product->category->name ?? 'Protein' }}</span>
      </div>

      <section class="detail-section">
        <div class="detail-left">
          <div class="detail-image-box">
            <img src="{{ $product->image ? asset($product->image) : '/photo/protein_moc.webp' }}" alt="{{ $product->name }}">
            @if($product->old_price && $product->old_price > $product->price)
              <span class="detail-sale-badge">
                {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% OFF
              </span>
            @endif
          </div>
        </div>

        <div class="detail-right">
          <div class="detail-top-row">
            <div>
              <p class="detail-category">{{ $product->category->name ?? 'Protein' }}</p>
              <h1 class="detail-title">{{ $product->name }}</h1>
            </div>

            <div class="detail-icons">
              <button class="detail-icon-btn" type="button" aria-label="Wishlist">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M12 20.2L11.1 19.38C6.4 15.12 3.3 12.32 3.3 8.88C3.3 6.08 5.5 4 8.1 4C9.57 4 10.98 4.69 12 5.77C13.02 4.69 14.43 4 15.9 4C18.5 4 20.7 6.08 20.7 8.88C20.7 12.32 17.6 15.12 12.9 19.38L12 20.2Z"
                        stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>

              <button class="detail-icon-btn" type="button" aria-label="Share">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                  <circle cx="18" cy="5" r="2.2" stroke="currentColor" stroke-width="1.4"/>
                  <circle cx="6" cy="12" r="2.2" stroke="currentColor" stroke-width="1.4"/>
                  <circle cx="18" cy="19" r="2.2" stroke="currentColor" stroke-width="1.4"/>
                  <path d="M8 11L15.8 6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                  <path d="M8 13L15.8 17.7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
          </div>

          <p class="detail-description">
            {{ $product->description }}
          </p>

          <div class="detail-price-wrap">
            <span class="detail-price-new">$ {{ number_format($product->price, 2) }}</span>
            @if($product->old_price)
              <span class="detail-price-old">$ {{ number_format($product->old_price, 2) }}</span>
            @endif
          </div>


            <form method="POST" action="{{ route('cart.add', $product) }}">
                @csrf

                <div class="detail-bottom-row">
                    <div class="detail-quantity">
                    <button type="button" onclick="this.parentNode.querySelector('input').stepDown()">−</button>
                    <input type="number" value="1" min="1" max="99" name="quantity">
                    <button type="button" onclick="this.parentNode.querySelector('input').stepUp()">+</button>
                    </div>

                    <button type="submit" id="addToCartBtn" class="detail-cart-btn">+ Add to Cart</button>
                </div>
                @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
            </form>
        </div>
      </section>

    </div>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-column">
          <h3>About Us</h3>
          <ul class="footer-links">
            <li><a href="#">Our Story</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Help</h3>
          <ul class="footer-links">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Shipping</a></li>
            <li><a href="#">Returns</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Account</h3>
          <ul class="footer-links">
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
            <li><a href="#">Orders</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Social Media</h3>
          <ul class="footer-links">
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
