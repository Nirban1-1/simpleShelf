<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookOrder;
use App\Models\Membership;

class OrdersController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get book orders (from book_orders table)
        $orders = BookOrder::with('books')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // other data for the same view
        $issuedBooks = $user->issuedBooks;            // collection
        $cartBooks   = $user->cartBooks;              // collection

        $subtotal = $cartBooks->sum(fn($b) => ($b->price ?? 0) * ($b->pivot->quantity ?? 1));
        $delivery = 5;
        $serviceFee = 2;
        $discount = 0;
        $total = $subtotal + $delivery + $serviceFee - $discount;
        $payableTotal = $total;

        $plans = Membership::all();
        $hasMembership = $user->hasMembership();
        $couponCode = session('cart_coupon_code', '');

        return view('orders.index', compact(
            'orders', 'issuedBooks', 'cartBooks',
            'subtotal', 'delivery', 'serviceFee', 'discount',
            'total', 'payableTotal', 'plans', 'hasMembership', 'couponCode'
        ));
    }


}
