<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-shop - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/home_page.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

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
          <button class="icon-btn" aria-label="Search">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"></circle>
              <path d="M20 20L16.65 16.65" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"></path>
            </svg>
          </button>

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

          @auth
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
          @else
          <a href="{{ route('login') }}" class="icon-btn" aria-label="Login">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M15 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M10 17L15 12L10 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15 12H3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
          @endauth
        </div>
      </nav>
    </div>
</header>

<section class="hero">
  <div class="hero-image">
    <p>Main visual — product photo / athlete</p>
  </div>
  <div class="hero-content">
    <div class="hero-badge">New Collection - Spring 2025</div>
    <h1 class="hero-title">Lorem ipsum dolor sit amet</h1>
    <div class="hero-buttons">
      <a href="/products" class="btn btn-primary">SHOP NOW</a>
      <a href="/products" class="btn btn-secondary">VIEW COLLECTION</a>
    </div>
    <div class="hero-dots">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header">
      <h2>Shop by category</h2>
      <a href="#" class="link">View all</a>
    </div>
    <div class="categories">
      <a href="/products/category/men" class="category-item">
        <div class="category-circle"></div>
        <p>men</p>
      </a>
      <a href="/products/category/women" class="category-item">
        <div class="category-circle"></div>
        <p>women</p>
      </a>
      <a href="/products/category/brands" class="category-item">
        <div class="category-circle"></div>
        <p>brands</p>
      </a>
      <a href="/products/category/food" class="category-item">
        <div class="category-circle"></div>
        <p>food</p>
      </a>
      <a href="/products/category/sports" class="category-item">
        <div class="category-circle"></div>
        <p>sports</p>
      </a>
      <a href="/products/category/accessories" class="category-item">
        <div class="category-circle"></div>
        <p>accessories</p>
      </a>
    </div>
  </div>
</section>

<section class="section section-gray">
  <div class="container">
    <div class="section-header">
      <h2>Bestsellers</h2>
      <a href="#" class="link">View all</a>
    </div>
    <div class="products">
      <div class="product-card">
        <span class="badge badge-discount">55% OFF</span>
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 36.00</span>
            <span class="price-old">$ 80.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="banners">
  <div class="banner">
    <p>Banner - summer collection</p>
  </div>
  <div class="banner">
    <p>Banner - shoe sale</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header">
      <h2>New arrivals</h2>
      <a href="#" class="link">View all</a>
    </div>
    <div class="products">
      <div class="product-card">
        <span class="badge badge-new">NEW</span>
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 36.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <span class="badge badge-new">NEW</span>
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image">
          <img src="/photo/protein_moc.webp" alt="Sport Protein">
        </div>
        <div class="product-info">
          <h3>Sport Protein</h3>
          <div class="product-footer">
            <span class="price">$ 40.00</span>
            <button class="wishlist" aria-label="Add to wishlist">♡</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
</body>
</html>
