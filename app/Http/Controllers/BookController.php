<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\IssuedBook;
use Illuminate\Support\Facades\Auth;
use App\Models\hasActiveMembership;
use App\Models\User;

class BookController extends Controller
{
    /**
     * Show all books (Homepage).
     */
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }

    /**
     * Show a single book + recommendations.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        // Get other books for recommendations
        $books = Book::where('id', '!=', $id)->get();

        return view('books.show', compact('book', 'books'));
    }


    public function search(Request $request)
{
    $query = $request->input('query');

    // Search for books by title or author
    $books = Book::where('title', 'LIKE', "%{$query}%")
                 ->orWhere('author', 'LIKE', "%{$query}%")
                 ->get();

    // If no books found
    if ($books->isEmpty()) {
        return redirect()->back()->with('error', 'No books found for your search.');
    }

    // If at least one book found, redirect to the first book's details page
    return redirect()->route('books.show', $books->first()->id);
}




    
public function autocomplete(Request $request)
{
    $query = $request->input('query');

    if (!$query) {
        return response()->json([]);
    }

    // Search only titles for suggestions
    $books = Book::where('title', 'LIKE', "%{$query}%")
                 ->limit(5) // show up to 5 suggestions
                 ->get(['id', 'title']);

    return response()->json($books);
}





    /**
     * Issue a book for the logged-in user.
     */
    public function issue($id)
    {
        $user = Auth::user();

        // Check active membership
        if (!$user->hasMembership()) {
            return redirect()->route('orders.index')
                ->with('error', 'You need a membership to issue books.');
        }

        // Check if book exists
        $book = Book::findOrFail($id);

        // Prevent issuing the same book twice
        $alreadyIssued = IssuedBook::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNull('return_date')
            ->exists();

        if ($alreadyIssued) {
            return redirect()->back()->with('error', 'You already issued this book.');
        }

        // Issue book
        IssuedBook::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'issued_date' => now(),
            'return_date' => now()->addDays(14), // matches IssuedBook model
        ]);

        return redirect()->route('orders.index')->with('success', 'Book issued successfully!');
    }
    public function returnBook($bookId)
    {
        $user = Auth::user();

        // Detach book from issued_books pivot
        $user->issuedBooks()->detach($bookId);

        return redirect()->route('orders.index')->with('success', 'Book returned successfully.');
    }






}

