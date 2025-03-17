@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pet</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('pets.update', $pet['id']) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $pet['name'] }}" required>
            </div>

            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control" required>
                    <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </div>

            <div class="form-group">
                <label>Photo URLs (one per line):</label>
                <textarea name="photoUrls[]" class="form-control" rows="3" required>
                @foreach($pet['photoUrls'] as $url){{ $url }}\n@endforeach
            </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
