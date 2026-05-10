<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request, $categorySlug = null)
    {
        $query = Product::query()->with('category');

        $selectedCategory = null;

        if ($categorySlug) {
            $selectedCategory = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $selectedCategory->id);
        }

        // PRICE RANGE
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->price_max);
        }

        // BRAND
        if ($request->filled('brand')) {
            $brands = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brands);
        }

        // COLOR
        if ($request->filled('color')) {
            $colors = is_array($request->color) ? $request->color : [$request->color];
            $query->whereIn('color', $colors);
        }

        // SIZE
        if ($request->filled('size')) {
            $sizes = is_array($request->size) ? $request->size : [$request->size];
            $query->whereIn('size', $sizes);
        }

        // SALE
        if ($request->filled('sale') && $request->sale === 'on-sale') {
            $query->where('is_on_sale', true);
        }

        // SORTING
        $sort = $request->get('sort', 'newest');

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $brandOptions = Product::query()
            ->when($selectedCategory, fn ($q) => $q->where('category_id', $selectedCategory->id))
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $colorOptions = Product::query()
            ->when($selectedCategory, fn ($q) => $q->where('category_id', $selectedCategory->id))
            ->whereNotNull('color')
            ->distinct()
            ->orderBy('color')
            ->pluck('color');

        $sizeOptions = Product::query()
            ->when($selectedCategory, fn ($q) => $q->where('category_id', $selectedCategory->id))
            ->whereNotNull('size')
            ->distinct()
            ->orderBy('size')
            ->pluck('size');

        $view = Auth::check() && Auth::user()->role === 'admin' ? 'products-admin' : 'products';

        return view($view, [
            'products' => $products,
            'selectedCategory' => $selectedCategory,
            'brandOptions' => $brandOptions,
            'colorOptions' => $colorOptions,
            'sizeOptions' => $sizeOptions,
        ]);
    }

    public function show(Product $product)
    {
        return view('product-detail', compact('product'));
    }
    public function search(Request $request)
    {
        $search = trim((string) $request->get('q', ''));

        $query = Product::query()->with('category');

        if ($search !== '') {
            $query->whereRaw(
                "to_tsvector('simple', coalesce(name,'') || ' ' || coalesce(description,'') || ' ' || coalesce(brand,'') || ' ' || coalesce(color,'')) @@ plainto_tsquery('simple', ?)",
                [$search]
            );
        }

        $products = $query
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $selectedCategory = null;

        $brandOptions = Product::whereNotNull('brand')->distinct()->orderBy('brand')->pluck('brand');
        $colorOptions = Product::whereNotNull('color')->distinct()->orderBy('color')->pluck('color');
        $sizeOptions = Product::whereNotNull('size')->distinct()->orderBy('size')->pluck('size');

        $view = Auth::check() && Auth::user()->role === 'admin' ? 'products-admin' : 'products';

        return view($view, [
            'products' => $products,
            'selectedCategory' => $selectedCategory,
            'brandOptions' => $brandOptions,
            'colorOptions' => $colorOptions,
            'sizeOptions' => $sizeOptions,
            'search' => $search,
        ]);
    }
}
