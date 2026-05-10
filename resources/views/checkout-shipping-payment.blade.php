<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping & Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/payment.css">
</head>
<body class="checkout-page">

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

  <main class="checkout-main">
    <div class="container">
      <div class="breadcrumb">Home / Shopping cart / <span>Shipping & Payment</span></div>

      <section class="checkout-steps">
        <div class="step done">
          <div class="step-circle">✓</div>
          <div class="step-label muted">Shopping cart</div>
        </div>
        <div class="step-line"></div>
        <div class="step active">
          <div class="step-circle">2</div>
          <div class="step-label active">Shipping & Payment</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-circle muted">3</div>
          <div class="step-label muted">Delivery details</div>
        </div>
      </section>

      <form method="POST" action="{{ route('checkout.shipping.store') }}">
        @csrf
        <section class="checkout-layout">
          <div class="checkout-left">

            @if($errors->any())
              <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <section class="checkout-block">
              <h2 class="section-title">Method of delivery</h2>

              <label class="option-card {{ old('delivery_method', 'courier') === 'courier' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="delivery_method" value="courier" data-price="4.90" {{ old('delivery_method', 'courier') === 'courier' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Courier (DPD / GLS)</div>
                    <div class="option-subtitle">Delivery within 2–3 business days</div>
                  </div>
                </div>
                <div class="option-price">€4.90</div>
              </label>

              <label class="option-card {{ old('delivery_method') === 'post' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="delivery_method" value="post" data-price="9.90" {{ old('delivery_method') === 'post' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Express shipping</div>
                    <div class="option-subtitle">Delivery on the next business day</div>
                  </div>
                </div>
                <div class="option-price">€9.90</div>
              </label>

              <label class="option-card {{ old('delivery_method') === 'personal' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="delivery_method" value="personal" data-price="2.90" {{ old('delivery_method') === 'personal' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Parcel box (Packeta / Z-box)</div>
                    <div class="option-subtitle">Delivery within 2–4 business days</div>
                  </div>
                </div>
                <div class="option-price">€2.90</div>
              </label>
            </section>

            <section class="checkout-block payment-block">
              <h2 class="section-title">Method of payment</h2>

              <label class="option-card {{ old('payment_method', 'card') === 'card' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="payment_method" value="card" {{ old('payment_method', 'card') === 'card' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Payment card</div>
                    <div class="option-subtitle">Visa, Mastercard, Maestro</div>
                  </div>
                </div>
              </label>

              <label class="option-card {{ old('payment_method') === 'transfer' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Bank transfer</div>
                    <div class="option-subtitle">Pay via bank transfer</div>
                  </div>
                </div>
              </label>

              <label class="option-card {{ old('payment_method') === 'cash' ? 'selected' : '' }}">
                <div class="option-left">
                  <input type="radio" name="payment_method" value="cash" {{ old('payment_method') === 'cash' ? 'checked' : '' }}>
                  <div class="option-text">
                    <div class="option-title">Cash on delivery</div>
                    <div class="option-subtitle">Payment upon delivery (+€1.50)</div>
                  </div>
                </div>
              </label>
            </section>

            <a href="{{ route('cart.index') }}" class="back-link">Back to cart</a>
          </div>

          <aside class="checkout-summary">
            <h2>Your order</h2>

            <div class="summary-products">
              @foreach($cart as $item)
                <div class="summary-product">
                  <div class="summary-thumb">
                    <img src="{{ $item['image'] ? asset($item['image']) : asset('/photo/protein_moc.webp') }}" alt="{{ $item['name'] }}" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="summary-name">{{ $item['name'] }} x{{ $item['quantity'] }}</div>
                  <div class="summary-price">$ {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                </div>
              @endforeach
            </div>

            <div class="summary-totals">
              <div class="summary-row">
                <span>Subtotal</span>
                <strong>$ {{ number_format($total, 2) }}</strong>
              </div>
              <div class="summary-row">
                <span>Shipping</span>
                <strong id="summary-shipping">$ 4.90</strong>
              </div>
              <div class="summary-row">
                <span>Discount</span>
                <strong>—</strong>
              </div>
              <div class="summary-divider"></div>
              <div class="summary-row total">
                <span>Total</span>
                <strong id="summary-total">$ {{ number_format($total + 4.90, 2) }}</strong>
              </div>
            </div>

            <button type="submit" class="continue-btn">Continue to delivery details</button>
          </aside>
        </section>
      </form>
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
  const subtotal = {{ $total }};

  function updateSummary(shippingCost) {
    document.getElementById('summary-shipping').textContent = '$ ' + shippingCost.toFixed(2);
    document.getElementById('summary-total').textContent = '$ ' + (subtotal + shippingCost).toFixed(2);
  }

  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="delivery_method"]');
    radios.forEach(function (radio) {
      radio.addEventListener('change', function () {
        updateSummary(parseFloat(this.dataset.price));
      });
    });

    // init
    const checked = document.querySelector('input[name="delivery_method"]:checked');
    if (checked) updateSummary(parseFloat(checked.dataset.price));
  });
</script>
</body>
</html>
