<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }
        $categories = Category::orderBy('name')->get();
        return view('product-add-admin', compact('categories'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'old_price'   => ['nullable', 'numeric', 'min:0'],
            'brand'       => ['nullable', 'string', 'max:50'],
            'size'        => ['nullable', 'string', 'max:10'],
            'color'       => ['nullable', 'string', 'max:30'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'is_on_sale'  => ['nullable'],
            'images'      => ['required', 'array', 'min:2'],
            'images.*'    => ['nullable', 'file', 'image', 'max:5120'],
        ]);

        $uploadedImages = array_filter($request->file('images') ?? [], fn($f) => $f !== null);
        if (count($uploadedImages) < 2) {
            return back()->withErrors(['images' => 'Please upload at least 2 images.'])->withInput();
        }

        $product = Product::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'old_price'   => $data['old_price'] ?? null,
            'brand'       => $data['brand'] ?? null,
            'size'        => $data['size'] ?? null,
            'color'       => $data['color'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'is_on_sale'  => $request->has('is_on_sale'),
            'image'       => null,
        ]);

        $isFirst = true;
        foreach ($uploadedImages as $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'is_main'    => $isFirst,
            ]);
            if ($isFirst) {
                $product->update(['image' => 'storage/' . $path]);
                $isFirst = false;
            }
        }

        return redirect('/products');
    }

    public function edit(Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }
        $categories = Category::orderBy('name')->get();
        return view('product-edit-admin', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'old_price'   => ['nullable', 'numeric', 'min:0'],
            'brand'       => ['nullable', 'string', 'max:50'],
            'size'        => ['nullable', 'string', 'max:10'],
            'color'       => ['nullable', 'string', 'max:30'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'images.*'    => ['nullable', 'file', 'image', 'max:5120'],
        ]);

        $product->update([
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'old_price'   => $data['old_price'] ?? null,
            'brand'       => $data['brand'] ?? null,
            'size'        => $data['size'] ?? null,
            'color'       => $data['color'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'is_on_sale'  => $request->has('is_on_sale'),
        ]);

        // Zmazanie označených fotiek
        $toDelete = array_filter($request->input('delete_images', []), fn($v) => is_numeric($v) && $v > 0);
        if (count($toDelete) > 0) {
            $product->images()->whereIn('id', $toDelete)->delete();
        }

        // Upload nových fotiek
        $uploadedImages = array_filter($request->file('images') ?? [], fn($f) => $f !== null);
        foreach ($uploadedImages as $file) {
            $isFirst = $product->images()->count() === 0;
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'is_main'    => $isFirst,
            ]);
            if ($isFirst) {
                $product->update(['image' => 'storage/' . $path]);
            }
        }

        // Ak je hlavná fotka zmazaná, nastav novú
        $mainExists = $product->images()->where('is_main', true)->exists();
        if (!$mainExists) {
            $first = $product->images()->first();
            if ($first) {
                $first->update(['is_main' => true]);
                $product->update(['image' => 'storage/' . $first->path]);
            } else {
                $product->update(['image' => null]);
            }
        }

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        $product->images()->delete();
        $product->delete();

        return redirect('/products');
    }
}
