<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Show all books on homepage
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }

    // Show a single book details by id
    public function show($id)
    {
    $book = Book::findOrFail($id);
    $books = Book::all();  // Or filtered recommendations if you want
    return view('books.show', compact('book', 'books'));
    }

}
