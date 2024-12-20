@extends('layouts.app')

@section('body')
    <h1 class="mb-0">Add Book</h1>
    <hr>
    <form action="{{ app()->environment('production') ? secure_url(route('book.store')) : route('book.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Book Name">
            </div>
            <div class="col">
                <input type="text" name="author" class="form-control" placeholder="Author">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="year" class="form-control" placeholder="Year">
            </div>
            <div class="col">
                <textarea name="description" class="form-control" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
