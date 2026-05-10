<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ShoppingBasket;
use App\Models\User;

class AuthController extends Controller{
    public function showLogin(){
        return view('auth.login');
    }

    public function logout(Request $request){
        $user = Auth::user();
        if ($user) {
            $cart = session()->get('cart', []);
            ShoppingBasket::where('id_user', $user->id)->delete();
            foreach ($cart as $productId => $item) {
                ShoppingBasket::create([
                    'id_user'          => $user->id,
                    'id_product'       => $productId,
                    'product_quantity' => $item['quantity'],
                ]);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $sessionCart = session()->get('cart', []);
            $user = Auth::user();
            $dbItems = ShoppingBasket::where('id_user', $user->id)->with('product')->get();
            $dbCart = [];
            foreach ($dbItems as $item) {
                if ($item->product) {
                    $dbCart[$item->id_product] = [
                        'id'       => $item->id_product,
                        'name'     => $item->product->name,
                        'price'    => (float) $item->product->price,
                        'old_price'=> $item->product->old_price,
                        'image'    => $item->product->image,
                        'quantity' => $item->product_quantity,
                    ];
                }
            }
            foreach ($sessionCart as $productId => $item) {
                if (isset($dbCart[$productId])) {
                    $dbCart[$productId]['quantity'] += $item['quantity'];
                } else {
                    $dbCart[$productId] = $item;
                }
            }
            session()->put('cart', $dbCart);
            ShoppingBasket::where('id_user', $user->id)->delete();
            foreach ($dbCart as $productId => $item) {
                ShoppingBasket::create([
                    'id_user'          => $user->id,
                    'id_product'       => $productId,
                    'product_quantity' => $item['quantity'],
                ]);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Nesprávny e-mail alebo heslo.',
        ])->onlyInput('email');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'unique:users'],
            'password'   => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => 'user',
            'is_active'  => true,
        ]);

        Auth::login($user);

        return redirect('/');
    }

}

