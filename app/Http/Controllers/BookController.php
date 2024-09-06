<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('category:id,name','authors:id,name')->paginate(8);

        return view('book.index')->with([
            'books' => $books
        ]);
    }

    public function show($id){
        $book = Book::with('reviews.user:id,name')->findOrFail($id);

        $averageRating = $book->reviews->count() > 0
            ? $book->reviews->avg('rating')
            : 0;

        return view('book.show')->with([
            'book' => $book,
            'averageRating' => $averageRating
        ]);
    }

}
