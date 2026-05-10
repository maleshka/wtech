<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShoppingBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function shipping()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout-shipping-payment', compact('cart', 'total'));
    }

    public function storeShipping(Request $request)
    {
        $request->validate([
            'delivery_method' => ['required', 'string'],
            'payment_method'  => ['required', 'string'],
        ]);

        session()->put('checkout.delivery_method', $request->delivery_method);
        session()->put('checkout.payment_method', $request->payment_method);

        return redirect()->route('checkout.delivery');
    }

    public function delivery()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        if (!session()->has('checkout.delivery_method')) {
            return redirect()->route('checkout.shipping');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $deliveryMethod = session()->get('checkout.delivery_method');
        $shippingCost = $this->shippingCost($deliveryMethod);

        return view('checkout-delivery', compact('cart', 'total', 'deliveryMethod', 'shippingCost'));
    }

    public function storeDelivery(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255'],
            'phone'      => ['required', 'string', 'max:50'],
            'street'     => ['required', 'string', 'max:255'],
            'city'       => ['required', 'string', 'max:255'],
            'postal'     => ['required', 'string', 'max:20'],
            'country'    => ['required', 'string', 'max:255'],
        ]);

        $cart = session()->get('cart', []);
        $deliveryMethod = session()->get('checkout.delivery_method');
        $paymentMethod  = session()->get('checkout.payment_method');
        $shippingCost   = $this->shippingCost($deliveryMethod);
        $subtotal       = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'id_user'         => Auth::id(),
            'total_price'     => $subtotal + $shippingCost,
            'delivery_method' => $deliveryMethod,
            'payment_method'  => $paymentMethod,
            'first_name'      => $request->first_name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'street'          => $request->street,
            'city'            => $request->city,
            'postal'          => $request->postal,
            'region'          => $request->region ?? '',
            'country'         => $request->country,
            'is_active'       => true,
        ]);

        foreach ($cart as $item) {
            OrderProduct::create([
                'id_order'         => $order->id,
                'id_product'       => $item['id'],
                'product_quantity' => $item['quantity'],
            ]);
        }

        // vymazat kosik
        session()->forget('cart');
        session()->forget('checkout');

        if (Auth::check()) {
            ShoppingBasket::where('id_user', Auth::id())->delete();
        }

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        return view('checkout-confirm');
    }

    private function shippingCost(string $method): float
    {
        return match($method) {
            'post'     => 9.90,
            'personal' => 2.90,
            default    => 4.90, // courier
        };
    }
}
