<!-- resources/views/books/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Edit Book</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/books/' . $book->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $book->price }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
@endsection
