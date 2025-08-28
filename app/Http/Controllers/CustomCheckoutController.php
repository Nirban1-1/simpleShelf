<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Order;

class CustomCheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $cartBooks = $user->cartBooks()->get(); // get books in cart
        if ($cartBooks->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // create a new order
        $order = Order::create([
            'user_id'        => $user->id,
            'name'           => $request->name,
            'address'        => $request->address,
            'contact'        => $request->contact,
            'payment_method' => $request->payment_method,
            'payment_option' => $request->online_option ?? $request->card_option ?? null,
            'status'         => 'confirmed',
            'total'          => $request->total ?? 0,
        ]);

        // attach books to order
        foreach ($cartBooks as $book) {
            $order->books()->attach($book->id, [
                'quantity' => $book->pivot->quantity,
                'price'    => $book->price,
            ]);
        }

        // clear user cart
        $user->cartBooks()->detach();

        return redirect()->route('orders.show')->with('success', 'Order placed successfully!');
    }
}
