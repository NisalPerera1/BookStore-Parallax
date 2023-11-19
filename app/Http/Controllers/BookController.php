<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

// Update the store and update methods in BookController

public function store(Request $request)
{
    $this->validateBook($request);

    Book::create($request->all());

    return redirect()->route('books.index')->with('success', 'Book created successfully.');
}

public function update(Request $request, $id)
{
    $this->validateBook($request);

    $book = Book::findOrFail($id);
    $book->update($request->all());

    return redirect()->route('books.index')->with('success', 'Book updated successfully.');
}

protected function validateBook(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);
}


    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }



    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    // Add methods for book issuance and return here...


// Add these methods to BookController

public function issueBook($id)
{
    $book = Book::findOrFail($id);
    
    if ($book->stock > 0) {
        $book->decrement('stock');
        // Add code here to associate the issuance with a user or member
        // Example: $book->issuances()->create(['user_id' => auth()->user()->id]);
        return redirect()->route('books.index')->with('success', 'Book issued successfully.');
    } else {
        return redirect()->route('books.index')->with('error', 'Book is out of stock.');
    }
}

public function returnBook($id)
{
    $book = Book::findOrFail($id);
    $book->increment('stock');
    // Add code here to associate the return with a user or member
    // Example: $book->returns()->create(['user_id' => auth()->user()->id]);
    return redirect()->route('books.index')->with('success', 'Book returned successfully.');
}


}

