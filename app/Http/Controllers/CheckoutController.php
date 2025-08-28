<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get cart items for this user
        $cartBooks = $user->cartBooks ?? collect(); // Eager load pivot if needed

        // Calculate subtotal
        $subtotal = $cartBooks->sum(function ($book) {
            return ($book->price ?? 0) * ($book->pivot->quantity ?? 1);
        });

        // Delivery charge (fixed or dynamic)
        $delivery = 5; // Example fixed delivery charge

        // Service charge (5% of subtotal as example)
        $serviceCharge = 2;

        // Coupon logic
    // Coupon
    $couponFlag = session('cart_coupon');       // 'PERCENT_10' or null
    $couponCode = session('cart_coupon_code');  // to show in UI
    $discount   = 0.0;
    if ($couponFlag === 'PERCENT_10') {
        $discount = round($subtotal * 0.10, 2);
    }

    elseif ($couponFlag === 'PERCENT_20') {
        $discount = round($subtotal * 0.20, 2);
    }

    elseif($couponFlag === 'PERCENT_25')
        {
        $discount = round($subtotal * 0.25, 2);
    };
        // Total calculation
        $total = $subtotal + $delivery + $serviceCharge - $discount;

        return view('checkout.index', compact(
            'cartBooks',
            'subtotal',
            'delivery',
            'serviceCharge',
            'discount',
            'total',
            'couponCode'
        ));
    }

    // Optional: store checkout details
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact' => 'required|string|max:20',
            'payment' => 'required|string',
            'onlineType' => 'nullable|string',
            'cardType' => 'nullable|string',
        ]);

        // You can now create an Order model here and save $validated data

        // Clear coupon after checkout if you want
        session()->forget(['cart_coupon', 'cart_coupon_code']);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
