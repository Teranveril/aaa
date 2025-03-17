@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add New Pet</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('web.pets.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pet Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Your Tag:</label>
                <input
                    type="text"
                    name="user_tag"
                    class="form-control"
                    value="{{ old('user_tag') }}"
                    required
                >
                @error('user_tag')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select" required>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Photo URLs (one per line):</label>
                <textarea
                    name="photoUrls[]"
                    class="form-control"
                    rows="3"
                    placeholder="Example:&#10;https://example.com/photo1.jpg&#10;https://example.com/photo2.jpg"
                    required
                ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('web.pets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
