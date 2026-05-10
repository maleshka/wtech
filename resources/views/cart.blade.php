<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/cart.css">
</head>
<body class="cart-page">

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

          <a href="{{ route('cart.index') }}" class="icon-btn active-icon" aria-label="Cart">
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

  <main class="cart-main">
    <div class="container">
      <div class="breadcrumb">Home / <span>Shopping cart</span></div>

      <section class="checkout-steps">
        <div class="step active">
          <div class="step-circle">1</div>
          <div class="step-label active">Shopping cart</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
          <div class="step-circle muted">2</div>
          <div class="step-label muted">Shipping & Payment</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
          <div class="step-circle muted">3</div>
          <div class="step-label muted">Delivery details</div>
        </div>
      </section>

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <section class="cart-layout">
        <div class="cart-left">
          <h1 class="cart-title">My cart</h1>

          <div class="cart-table-head">
            <div>Product</div>
            <div>Price</div>
            <div>Quantity</div>
            <div>Total</div>
            <div></div>
          </div>

          <div id="cartItems" class="cart-items">
            @forelse($cart as $item)
              <div class="cart-row">
                <div class="cart-product">
                  <div class="cart-thumb">
                    <img
                      src="{{ $item['image'] ? asset($item['image']) : asset('/photo/protein_moc.webp') }}"
                      alt="{{ $item['name'] }}"
                      style="width:100%; height:100%; object-fit:cover;"
                    >
                  </div>

                  <div class="cart-product-info">
                    <div class="cart-name-line">{{ $item['name'] }}</div>
                    <div class="cart-sub-line">
                      @if(!empty($item['old_price']))
                        <span style="text-decoration: line-through; opacity: .6;">
                          $ {{ number_format($item['old_price'], 2) }}
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="cart-price">
                  $ {{ number_format($item['price'], 2) }}
                </div>

                <div class="cart-qty">
                  <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="cart-qty-form">
                    @csrf
                    <button
                      type="button"
                      onclick="decreaseQty(this)"
                    >−</button>

                    <input
                      type="number"
                      name="quantity"
                      value="{{ $item['quantity'] }}"
                      min="1"
                      max="99"
                      class="cart-qty-input"
                    >

                    <button
                      type="button"
                      onclick="increaseQty(this)"
                    >+</button>
                  </form>
                </div>

                <div class="cart-total">
                  $ {{ number_format($item['price'] * $item['quantity'], 2) }}
                </div>

                <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                  @csrf
                  <button class="cart-remove" type="submit">⊗</button>
                </form>
              </div>
            @empty
              <div class="cart-row" style="grid-template-columns: 1fr;">
                <div class="cart-product-info">
                  <div class="cart-name-line">Your cart is empty.</div>
                  <div class="cart-sub-line">
                    <a href="/products" style="text-decoration: underline; color: inherit;">Continue shopping</a>
                  </div>
                </div>
              </div>
            @endforelse
          </div>
        </div>

        <aside class="cart-summary">
          <h2>Order summary</h2>

          <div class="summary-row">
            <span>Subtotal</span>
            <strong>$ {{ number_format($total, 2) }}</strong>
          </div>

          <div class="summary-row">
            <span>Shipping</span>
            <strong>—</strong>
          </div>

          <div class="summary-row">
            <span>Discount</span>
            <strong>—</strong>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-row total">
            <span>Total</span>
            <strong>$ {{ number_format($total, 2) }}</strong>
          </div>

          <label class="promo-label">Discount code / Promo code</label>
          <div class="promo-row">
            <input type="text" placeholder="code">
            <button type="button">Confirm</button>
          </div>

          <a href="{{ route('checkout.shipping') }}" class="continue-btn">Continue</a>
        </aside>
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
<script>
  function increaseQty(button) {
    const form = button.closest('form');
    const input = form.querySelector('.cart-qty-input');
    let value = parseInt(input.value || 1, 10);
    if (value < 99) {
      input.value = value + 1;
      form.submit();
    }
  }

  function decreaseQty(button) {
    const form = button.closest('form');
    const input = form.querySelector('.cart-qty-input');
    let value = parseInt(input.value || 1, 10);
    if (value > 1) {
      input.value = value - 1;
      form.submit();
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cart-qty-input').forEach(input => {
      input.addEventListener('change', function () {
        this.closest('form').submit();
      });
    });
  });
</script>
</body>
</html>
