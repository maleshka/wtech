<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Product</title>
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
                        <a href="/products" class="nav-link active">Men</a>
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

            <div class="breadcrumb-custom">
                {{ $product->category->name ?? 'Mens' }} / <span>Edit product</span>
            </div>

            <div class="add-title-row">
                <h1 class="catalog-title">Edit product</h1>
            </div>

            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Hidden inputy pre mazanie fotiek --}}
                @foreach($product->images as $img)
                    <input type="hidden" name="delete_images[]" id="delete-img-{{ $img->id }}" value="">
                @endforeach

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
                        @php
                            $allSlots = $product->images->values();
                            $mainImg = $allSlots->first();
                        @endphp

                        {{-- Main slot --}}
                        @if($mainImg)
                            <div class="upload-main" style="position:relative; background:#ececec; padding:0;">
                                <img src="{{ asset('storage/' . $mainImg->path) }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:contain;">
                                <button type="button"
                                    onclick="deleteImage({{ $mainImg->id }}, 'delete-img-{{ $mainImg->id }}', this.closest('.upload-main'))"
                                    style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.5); border:none; color:#fff; width:24px; height:24px; cursor:pointer; font-size:14px; line-height:1;">✕</button>
                            </div>
                        @else
                            <div class="upload-main" onclick="document.getElementById('edit-img0').click()" style="cursor:pointer; position:relative;">
                                <img id="edit-img0-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                <div id="edit-img0-plus" style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                    <div class="upload-plus">＋</div>
                                    <div class="upload-label">Upload main image</div>
                                    <div class="upload-sub">PNG, JPG — max 5MB</div>
                                </div>
                                <input type="file" id="edit-img0" name="images[0]" accept="image/*" style="display:none;" onchange="previewEditThumb(this, 'edit-img0-preview', 'edit-img0-plus')">
                            </div>
                        @endif

                        {{-- Thumb slots --}}
                        <div class="upload-thumbs">
                            @for($i = 1; $i <= 4; $i++)
                                @php $img = $allSlots->get($i); @endphp
                                @if($img)
                                    <div class="upload-thumb" style="position:relative; background:#ececec; padding:0;">
                                        <img src="{{ asset('storage/' . $img->path) }}" alt="" style="width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                        <button type="button"
                                            onclick="deleteImage({{ $img->id }}, 'delete-img-{{ $img->id }}', this.closest('.upload-thumb'))"
                                            style="position:absolute; top:4px; right:4px; background:rgba(0,0,0,0.5); border:none; color:#fff; width:20px; height:20px; cursor:pointer; font-size:12px; line-height:1; z-index:1;">✕</button>
                                    </div>
                                @else
                                    <div class="upload-thumb" onclick="document.getElementById('edit-img{{ $i }}').click()" style="cursor:pointer; position:relative;">
                                        <img id="edit-img{{ $i }}-preview" src="" alt="" style="display:none; width:100%; height:100%; object-fit:contain; position:absolute; top:0; left:0;">
                                        <span id="edit-img{{ $i }}-plus">＋</span>
                                        <input type="file" id="edit-img{{ $i }}" name="images[{{ $i }}]" accept="image/*" style="display:none;" onchange="previewEditThumb(this, 'edit-img{{ $i }}-preview', 'edit-img{{ $i }}-plus')">
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <div class="add-form-col">

                        <div class="add-section">
                            <div class="add-section-title">Basic info</div>
                            <div class="add-grid">
                                <div class="add-field full">
                                    <label class="add-label">Product name</label>
                                    <input class="add-input" type="text" name="name" value="{{ old('name', $product->name) }}" required>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Category</label>
                                    <select class="add-select" name="category_id">
                                        <option value="">-- Select --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Brand</label>
                                    <input class="add-input" type="text" name="brand" value="{{ old('brand', $product->brand) }}">
                                </div>
                                <div class="add-field full">
                                    <label class="add-label">Description</label>
                                    <textarea class="add-textarea" name="description" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Pricing</div>
                            <div class="add-grid">
                                <div class="add-field">
                                    <label class="add-label">Price ($)</label>
                                    <input class="add-input" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                                <div class="add-field">
                                    <label class="add-label">Original price ($)</label>
                                    <input class="add-input" type="number" step="0.01" name="old_price" value="{{ old('old_price', $product->old_price) }}">
                                </div>
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Variants</div>
                            <div class="add-field">
                                <label class="add-label">Size</label>
                                <input class="add-input" type="text" name="size" value="{{ old('size', $product->size) }}">
                            </div>
                            <div class="add-field" style="margin-top:14px;">
                                <label class="add-label">Color</label>
                                <input class="add-input" type="text" name="color" value="{{ old('color', $product->color) }}">
                            </div>
                        </div>

                        <div class="add-section">
                            <div class="add-section-title">Settings</div>
                            <div class="add-checks">
                                <div class="add-check-row">
                                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale) ? 'checked' : '' }}>
                                    <span>On Sale</span>
                                </div>
                            </div>
                        </div>

                        <div class="add-actions">
                            <button class="add-btn-save" type="submit">Save Changes</button>
                            <button class="add-btn-delete" type="button" form="delete-form" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
                            <a href="/products" class="add-btn-cancel">Cancel</a>
                        </div>

                    </div>
                </div>
            </form>

        </div>

        <form id="delete-form" method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
            @csrf
            @method('DELETE')
        </form>
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
function previewEditThumb(input, previewId, plusId) {
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

function deleteImage(imageId, inputId, slotEl) {
    document.getElementById(inputId).value = imageId;
    slotEl.innerHTML = '<span style="color:#ccc; font-size:22px;">＋</span>';
    slotEl.style.background = '#ececec';
    slotEl.style.cursor = 'default';
}
</script>
</body>
</html>
