@extends('layouts.app')

@section('content')
    <h2>Book List</h2>
    <a href="{{ url('/books/create') }}" class="btn btn-primary">Add Book</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    @if (count($books) > 0)
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            {{ $book->stock }}
                            @if ($book->stock == 0)
                                <span class="badge badge-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ url('/books/' . $book->id . '/issue') }}" method="post" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" {{ $book->stock == 0 ? 'disabled' : '' }}>Issue</button>
                            </form>
                            <form action="{{ url('/books/' . $book->id . '/return') }}" method="post" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info" {{ $book->stock == $book->initial_stock ? 'disabled' : '' }}>Return</button>
                            </form>
                            <a href="{{ url('/books/' . $book->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ url('/books/' . $book->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No books available.</p>
    @endif
@endsection
