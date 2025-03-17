@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Pets Management</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="alert alert-dark mb-4">
            <h4 class="alert-heading">System Category</h4>
            <p class="mb-0">
                All pets are filtered by hardcoded category:
                <strong>CUSTOM_LARAVEL_APP_PETS</strong>
            </p>
        </div>
        <a href="{{ route('web.pets.create') }}" class="btn btn-primary mb-3">Add New Pet</a>

        <div class="card">
            <div class="card-body">
                @if(empty($pets))
                    <div class="alert alert-warning">No pets found in the store</div>
                @else
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pets as $pet)
                            <tr>
                                <td>{{ $pet['id'] ?? 'N/A' }}</td>
                                <td>{{ $pet['name'] ?? 'Unnamed Pet' }}</td>
                                <td>
                                    <span class="badge bg-{{ match($pet['status'] ?? null) {
                                        'available' => 'success',
                                        'pending' => 'warning',
                                        'sold' => 'danger',
                                        default => 'secondary'}
                                    }}">
                                        {{ $pet['status'] ?? 'unknown' }}
                                    </span>
                                </td>
                                <td>
                                    @if(isset($pet['id']))
                                        <a
                                            href="{{ route('web.pets.edit', $pet['id']) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>
                                        <form
                                            action="{{ route('web.pets.destroy', $pet['id']) }}"
                                            method="POST"
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Invalid record</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
