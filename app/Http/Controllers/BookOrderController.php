<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookOrder;
use App\Models\Book;

class BookOrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Get cart items
        $cartBooks = $user->cartBooks()->get();

        if ($cartBooks->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $subtotal = $cartBooks->sum(fn($b) => ($b->price ?? 0) * ($b->pivot->quantity ?? 1));
        $delivery = 5.00;      // or compute dynamically
        $serviceFee = 2.00;    // or compute dynamically
        $discount = 0.00;      // compute if coupon present
        $total = $subtotal + $delivery + $serviceFee - $discount;

        // Create book order in book_orders table
        $order = BookOrder::create([
            'user_id'         => $user->id,
            'subtotal'        => $subtotal,
            'delivery_charge' => $delivery,
            'service_charge'  => $serviceFee,
            'discount'        => $discount,
            'total'           => $total,
            'status'          => 'confirmed', // or 'pending' depending on flow
        ]);

        // Attach books to pivot table book_order_items
        foreach ($cartBooks as $book) {
            $order->books()->attach($book->id, [
                'quantity' => $book->pivot->quantity ?? 1,
                'price'    => $book->price ?? 0,
            ]);
        }

        // Clear user's cart (optional)
        $user->cartBooks()->detach();

        // Redirect to orders page to show the newly created order
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }


    public function clearHistory(Request $request)
{
    $user = Auth::user();

    // Delete all orders belonging to this user
    BookOrder::where('user_id', $user->id)->delete();

    return redirect()->back()->with('success', 'Your order history has been cleared.');
}

}
