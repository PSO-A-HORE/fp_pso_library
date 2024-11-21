@extends('layouts.app')

@section('body')
    <h1 class="mb-0">Detail Book</h1>
    <hr />
    <form action="{{ route('book.update', $book->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Book Name" value="{{ $book->name }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" placeholder="Author" value="{{ $book->author }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Year</label>
                <input type="text" name="year" class="form-control" placeholder="Year" value="{{ $book->year }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Descriptoin">{{ $book->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
