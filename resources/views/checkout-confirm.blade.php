<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/delivery.css">
  <link rel="stylesheet" href="/css/order-confirm.css">
</head>
<body class="delivery-page">

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
        <a href="/cart" class="icon-btn" aria-label="Cart">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M8 8V6.5C8 4.57 9.57 3 11.5 3C13.43 3 15 4.57 15 6.5V8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            <path d="M5 8H18L17 19.5C16.93 20.37 16.2 21 15.33 21H7.67C6.8 21 6.07 20.37 6 19.5L5 8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
          </svg>
        </a>
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

<main class="delivery-main">
  <div class="container">
    <div class="breadcrumb">Home / Shopping cart / Shipping & Payment / Delivery details / <span>Order Confirmation</span></div>

    <section class="checkout-steps">
      <div class="step done">
        <div class="step-circle">✓</div>
        <div class="step-label muted">Shopping cart</div>
      </div>
      <div class="step-line"></div>
      <div class="step done">
        <div class="step-circle">✓</div>
        <div class="step-label muted">Shipping & Payment</div>
      </div>
      <div class="step-line"></div>
      <div class="step done">
        <div class="step-circle">✓</div>
        <div class="step-label muted">Delivery details</div>
      </div>
    </section>

    <section class="confirmation-container">
      <div class="confirmation-success">
        <h1 class="success-title">Thank you for your order!</h1>
        <p class="success-subtitle">Your order has been successfully placed.</p>
      </div>

      <div class="confirmation-actions">
        <a href="/" class="continue-shopping-btn">Continue Shopping</a>
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
