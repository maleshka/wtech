<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/products-page.css">
    <link rel="stylesheet" href="/css/add_new_product_admin.css">
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
                        <a href="/products/category/men" class="nav-link active">Men</a>
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
                            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M20 20L16.65 16.65" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <a href="/cart" class="icon-btn" aria-label="Cart">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M8 8V6.5C8 4.57 9.57 3 11.5 3C13.43 3 15 4.57 15 6.5V8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            <path d="M5 8H18L17 19.5C16.93 20.37 16.2 21 15.33 21H7.67C6.8 21 6.07 20.37 6 19.5L5 8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <button class="icon-btn" aria-label="Account">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M6.8 19.2C7.8 16.9 9.6 15.7 12 15.7C14.4 15.7 16.2 16.9 17.2 19.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
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

    <main class="add-main">
        <div class="container">

            <div class="breadcrumb-custom">Mens / Food / Protein / <span>Add new product</span></div>

            <div class="add-title-row">
                <h1 class="catalog-title">Add new product</h1>
            </div>

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="add-layout">

                    <div class="add-image-col">
                        <div class="upload-main" onclick="document.getElementById('img0').click()" style="cursor:pointer; position:relative;">
                            <div class="upload-plus" id="img0-plus">＋</div>
                            <div class="upload-label">Upload main image</div>
                            <div class="upload-sub">PNG, JPG — max 5MB</div>
                            <img id="img0-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute;">
                            <input type="file" id="img0" name="images[0]" accept="image/*" required style="display:none;" onchange="previewImage(this, 'img0-preview', 'img0-plus', 'img0-label', 'img0-sub')">
                        </div>
                        <div class="upload-thumbs">
                            <div class="upload-thumb" onclick="document.getElementById('img1').click()" style="cursor:pointer; position:relative;">
                                <span id="img1-plus">＋</span>
                                <img id="img1-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                <input type="file" id="img1" name="images[1]" accept="image/*" required style="display:none;" onchange="previewThumb(this, 'img1-preview', 'img1-plus')">
                            </div>
                            <div class="upload-thumb" onclick="document.getElementById('img2').click()" style="cursor:pointer; position:relative;">
                                <span id="img2-plus">＋</span>
                                <img id="img2-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                <input type="file" id="img2" name="images[2]" accept="image/*" style="display:none;" onchange="previewThumb(this, 'img2-preview', 'img2-plus')">
                            </div>
                            <div class="upload-thumb" onclick="document.getElementById('img3').click()" style="cursor:pointer; position:relative;">
                                <span id="img3-plus">＋</span>
                                <img id="img3-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                <input type="file" id="img3" name="images[3]" accept="image/*" style="display:none;" onchange="previewThumb(this, 'img3-preview', 'img3-plus')">
                            </div>
                            <div class="upload-thumb" onclick="document.getElementById('img4').click()" style="cursor:pointer; position:relative;">
                                <span id="img4-plus">＋</span>
                                <img id="img4-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                <input type="file" id="img4" name="images[4]" accept="image/*" style="display:none;" onchange="previewThumb(this, 'img4-preview', 'img4-plus')">
                            </div>
                        </div>
                    </div>

                    <div class="add-form-col">

                        <div class="add-section">
                            <div class="add-section-title">Basic info</div>
                            <div class="add-grid">
                                <div class="add-field full">
                                    <label class="add-label">Product name</label>
                                    <input class="add-input" type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Sport Protein Extra" required>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Category</label>
                                    <select class="add-select" name="category_id">
                                        <option value="">-- Select --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Brand</label>
                                    <input class="add-input" type="text" name="brand" value="{{ old('brand') }}" placeholder="e.g. MyProtein">
                                </div>
                                <div class="add-field full">
                                    <label class="add-label">Description</label>
                                    <textarea class="add-textarea" name="description" placeholder="Product description..." required>{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Pricing</div>
                            <div class="add-grid">
                                <div class="add-field">
                                    <label class="add-label">Price ($)</label>
                                    <input class="add-input" type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Original price ($)</label>
                                    <input class="add-input" type="number" step="0.01" name="old_price" value="{{ old('old_price') }}" placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Variants</div>
                            <div class="add-field">
                                <label class="add-label">Size</label>
                                <input class="add-input" type="text" name="size" value="{{ old('size') }}" placeholder="e.g. XL">
                            </div>
                            <div class="add-field" style="margin-top: 14px;">
                                <label class="add-label">Color</label>
                                <input class="add-input" type="text" name="color" value="{{ old('color') }}" placeholder="e.g. Black">
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Settings</div>
                            <div class="add-checks">
                                <div class="add-check-row">
                                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale') ? 'checked' : '' }}>
                                    <span>On Sale</span>
                                </div>
                            </div>
                        </div>

                        <div class="add-actions">
                            <button class="add-btn-save" type="submit">Save product</button>
                            <a href="/products" class="add-btn-cancel">Cancel</a>
                        </div>

                    </div>
                </div>
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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewImage(input, previewId, plusId, labelId, subId) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        preview.src = e.target.result;
        preview.style.display = 'block';
        document.getElementById(plusId).style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

function previewThumb(input, previewId, plusId) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        preview.src = e.target.result;
        preview.style.display = 'block';
        document.getElementById(plusId).style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
</body>
</html>
