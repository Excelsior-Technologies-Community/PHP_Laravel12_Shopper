<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'cart_items' => 'required|array',
        ]);

        $cartItems = $request->cart_items;

        if (isset($cartItems['product_id'])) {
            $cartItems = [$cartItems];
        }

        $totalAmount = 0;
        $validItems = [];

        foreach ($cartItems as $item) {
            if (is_string($item)) {
                $item = json_decode($item, true);
            }

            if (!is_array($item) || !isset($item['product_id'])) {
                continue;
            }

            $product = DB::table('sh_products')->where('id', $item['product_id'])->first();

            if (!$product || $product->security_stock < $item['quantity']) {
                return back()->with('error', 'Some products are out of stock or do not exist.');
            }

            $totalAmount += ($product->price_amount ?? 0) * $item['quantity'];
            $validItems[] = $item;
        }

        if (empty($validItems)) {
            return back()->with('error', 'Invalid cart items.');
        }

        DB::transaction(function () use ($request, $validItems, $totalAmount) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'SHP-' . strtoupper(Str::random(10)),
                'total_amount' => $totalAmount,
                'status' => 'Processing',
                'shipping_address' => $request->shipping_address
            ]);

            foreach ($validItems as $item) {
                $product = DB::table('sh_products')->where('id', $item['product_id'])->first();

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price_amount ?? 0
                ]);

                DB::table('sh_products')
                    ->where('id', $item['product_id'])
                    ->decrement('security_stock', $item['quantity']);
            }
        });

        return redirect('/orders')->with('success', 'Order placed successfully.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function track($id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.track', compact('order'));
    }

    public function downloadInvoice($id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.invoice', compact('order'));
    }
}