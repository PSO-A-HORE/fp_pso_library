@extends('layouts.app')

@section('body')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Book</h1>
        <a href="{{ app()->environment('production') ? secure_url(route('book.create')) : route('book.create') }}" class="btn btn-primary">Add Book</a>
    </div>
    <hr>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Author</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($books->count() > 0)
                @foreach ($books as $book)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $book->name }}</td>
                        <td class="align-middle">{{ $book->author }}</td>
                        <td class="align-middle">{{ $book->year }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ app()->environment('production') ? secure_url(route('book.show', $book->id)) : route('book.show', $book->id) }}" type="button" class="btn btn-secondary">Detail</a>
                            <a href="{{ app()->environment('production') ? secure_url(route('book.edit', $book->id)) : route('book.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ app()->environment('production') ? secure_url(route('book.destroy', $book->id)) : route('book.destroy', $book->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Book not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
