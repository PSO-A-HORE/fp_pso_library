@extends('layouts.app')

@section('body')
    <h1>Welcome to Library</h1>

    <!-- Form untuk input username dan NRP -->
    <form action="{{ route('submitForm') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="nrp">NRP:</label>
            <input type="text" id="nrp" name="nrp" required>
        </div>
        <div>
            <button type="submit">Kirim</button>
        </div>
    </form>
@endsection
