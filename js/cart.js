function getCart() {
  return JSON.parse(localStorage.getItem('cart')) || [];
}

function saveCart(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(productId, quantity = 1) {
  const cart = getCart();
  const existing = cart.find(item => item.id === productId);

  if (existing) {
    existing.quantity += quantity;
  } else {
    cart.push({ id: productId, quantity });
  }

  saveCart(cart);
  alert('Product added to cart');
}

function removeFromCart(productId) {
  const cart = getCart().filter(item => item.id !== productId);
  saveCart(cart);
  renderCart();
}

function updateQuantity(productId, quantity) {
  const cart = getCart().map(item => item.id === productId ? { ...item, quantity: Math.max(1, quantity) } : item);
  saveCart(cart);
  renderCart();
}

function renderCart() {
  const cartItems = document.getElementById('cartItems');
  const subtotalEl = document.getElementById('subtotal');
  const totalEl = document.getElementById('total');
  if (!cartItems) return;

  const cart = getCart();
  let subtotal = 0;

  cartItems.innerHTML = cart.map(item => {
    const product = products.find(p => p.id === item.id);
    const lineTotal = product.price * item.quantity;
    subtotal += lineTotal;

    return `
      <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
          <div>
            <h3 class="h6 mb-1">${product.name}</h3>
            <small class="text-muted">${product.brand}</small>
          </div>
          <div>$${product.price.toFixed(2)}</div>
          <div>
            <input type="number" min="1" value="${item.quantity}" class="form-control" style="width: 90px;" onchange="updateQuantity(${item.id}, Number(this.value))">
          </div>
          <div class="fw-bold">$${lineTotal.toFixed(2)}</div>
          <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">Remove</button>
        </div>
      </div>
    `;
  }).join('');

  subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
  totalEl.textContent = `$${subtotal.toFixed(2)}`;
}

const addToCartBtn = document.getElementById('addToCartBtn');
if (addToCartBtn) {
  addToCartBtn.addEventListener('click', () => {
    const params = new URLSearchParams(window.location.search);
    const id = Number(params.get('id')) || 1;
    const qty = Number(document.getElementById('detailQty')?.value) || 1;
    addToCart(id, qty);
  });
}

if (document.getElementById('cartItems')) {
  renderCart();
}