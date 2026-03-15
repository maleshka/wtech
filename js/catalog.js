const itemsPerPage = 6;
let currentPage = 1;
let filteredProducts = [...products];

function getFilters() {
  return {
    search: document.getElementById('searchInput')?.value.trim().toLowerCase() || '',
    priceFrom: Number(document.getElementById('priceFrom')?.value) || 0,
    priceTo: Number(document.getElementById('priceTo')?.value) || Infinity,
    brand: document.getElementById('brandFilter')?.value || '',
    color: document.getElementById('colorFilter')?.value || '',
    sort: document.getElementById('sortSelect')?.value || 'newest'
  };
}

function applyFiltersAndRender() {
  const { search, priceFrom, priceTo, brand, color, sort } = getFilters();

  filteredProducts = products.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(search);
    const matchesPrice = product.price >= priceFrom && product.price <= priceTo;
    const matchesBrand = !brand || product.brand === brand;
    const matchesColor = !color || product.color === color;
    return matchesSearch && matchesPrice && matchesBrand && matchesColor;
  });

  if (sort === 'price-asc') filteredProducts.sort((a, b) => a.price - b.price);
  if (sort === 'price-desc') filteredProducts.sort((a, b) => b.price - a.price);

  currentPage = 1;
  renderProducts();
  renderPagination();
}

function renderProducts() {
  const grid = document.getElementById('productGrid');
  const count = document.getElementById('productCount');
  if (!grid) return;

  count.textContent = `(${filteredProducts.length})`;

  const start = (currentPage - 1) * itemsPerPage;
  const pageItems = filteredProducts.slice(start, start + itemsPerPage);

  grid.innerHTML = pageItems.map(product => `
    <div class="col-md-6 col-xl-4">
      <div class="card h-100 border-0 shadow-sm">
        <img src="${product.image}" class="card-img-top" alt="${product.name}">
        <div class="card-body">
          <h3 class="h6">${product.name}</h3>
          <p class="mb-1 fw-bold">$${product.price.toFixed(2)} <span class="text-danger text-decoration-line-through small">$${product.oldPrice.toFixed(2)}</span></p>
          <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">${product.brand} · ${product.color}</small>
            <a href="product-detail.html?id=${product.id}" class="btn btn-sm btn-outline-dark">Detail</a>
          </div>
        </div>
      </div>
    </div>
  `).join('');
}

function renderPagination() {
  const pagination = document.getElementById('pagination');
  if (!pagination) return;

  const pages = Math.ceil(filteredProducts.length / itemsPerPage);
  pagination.innerHTML = '';

  for (let i = 1; i <= pages; i++) {
    pagination.innerHTML += `
      <li class="page-item ${i === currentPage ? 'active' : ''}">
        <button class="page-link" onclick="goToPage(${i})">${i}</button>
      </li>
    `;
  }
}

function goToPage(page) {
    currentPage = page;
    renderProducts();
    renderPagination();
    applyFiltersAndRender();
}

document.getElementById('applyFilters')?.addEventListener('click', applyFiltersAndRender);
document.getElementById('resetFilters')?.addEventListener('click', () => location.reload());
document.getElementById('sortSelect')?.addEventListener('change', applyFiltersAndRender);
document.getElementById('searchInput')?.addEventListener('input', applyFiltersAndRender);

applyFiltersAndRender();