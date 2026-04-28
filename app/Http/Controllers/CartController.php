<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB ;
use Illuminate\Http\Request;
use Shopper\Core\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

   
public function add($id)
{
    dd(session()->get('cart'));
    $product = \DB::table('sh_products')->where('id', $id)->first();

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => 0,
            "qty" => 1
        ];
    }

    session()->put('cart', $cart);

    // 👇 IMPORTANT CHANGE HERE
    return redirect('/cart')->with('success', 'Product added to cart');
}

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Removed from cart');
    }

    public function checkout(Request $request)
{
    $cart = session()->get('cart');

    if (!$cart) {
        return redirect('/cart')->with('error', 'Cart is empty');
    }

    // For now just clear cart (simple demo)
    session()->forget('cart');

    return redirect('/cart')->with('success', 'Order placed successfully!');
}
}