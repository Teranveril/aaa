@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pet</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('web.pets.update', $pet['id']) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Pet Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $pet['name'] }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select" required>
                    <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Photo URLs:</label>
                <textarea
                    name="photoUrls[]"
                    class="form-control"
                    rows="3"
                    required
                >{{ implode("\n", $pet['photoUrls']) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('web.pets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
