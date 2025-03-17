@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Edit Pet</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
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
            @if(isset($pet['category']))
                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $pet['category']['name'] }} (ID: {{ $pet['category']['id'] }})"
                        readonly
                    >
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Photo URLs (one per line):</label>
                <textarea
                    name="photoUrls"
                    class="form-control"
                    rows="3"
                    required
                    placeholder="Example:&#10;https://fastly.picsum.photos/id/330/200/300.jpg"
                >{{ implode("\n", $pet['photoUrls'] ?? []) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('web.pets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
