<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add a book to cart (increments qty if already there)
    public function add(Book $book)
    {
        $user = Auth::user();

        $existing = $user->cartBooks()->where('book_id', $book->id)->first();
        if ($existing) {
            $user->cartBooks()
                 ->updateExistingPivot($book->id, [
                     'quantity' => max(1, ($existing->pivot->quantity ?? 1) + 1)
                 ]);
        } else {
            $user->cartBooks()->attach($book->id, ['quantity' => 1]);
        }

        return redirect()->route('orders.index')->with('success', 'Book added to cart!');
    }

    // Update quantity
    public function updateQty(Request $request, Book $book)
    {
        $user = Auth::user();
        $qty = max(1, (int)$request->input('quantity', 1));
        $user->cartBooks()->updateExistingPivot($book->id, ['quantity' => $qty]);

        return back()->with('success', 'Quantity updated.');
    }

    // Remove from cart
    public function remove(Book $book)
    {
        $user = Auth::user();
        $user->cartBooks()->detach($book->id);

        return back()->with('success', 'Book removed from cart.');
    }

    // Apply a very simple coupon demo (SAVE10 = 10% off subtotal)
    public function applyCoupon(Request $request)
    {
        $code = strtoupper(trim($request->input('code')));

        $discount = 0;
        if ($code === 'SAVE10') {
            $discount = 'PERCENT_10'; 
        }
        elseif ($code === 'T20') {
            $discount = 'PERCENT_20'; 
        }
        elseif ($code === 'FLASH25') {
            $discount = 'PERCENT_25'; 
        }

        session(['cart_coupon' => $discount, 'cart_coupon_code' => $code]);

        return back()->with('success', $discount ? 'Coupon applied!' : 'Invalid coupon.');
    }
}
