<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Zwierząt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Lista Zwierząt</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Dodaj Zwierzę</a>
    @isset($pets)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Status</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($pets as $pet)
                <tr>
                    <td>{{ $pet['id'] ?? 'Brak' }}</td>
                    <td>{{ $pet['name'] ?? 'Brak' }}</td>
                    <td>{{ $pet['status'] ?? 'Brak' }}</td>
                    <td>
                        <a href="{{ route('pets.show', $pet['id']) }}" class="btn btn-sm btn-info">Szczegóły</a>
                        <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-sm btn-warning">Edytuj</a>
                        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć to zwierzę?')">Usuń</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Brak zwierząt do wyświetlenia.</td></tr>
            @endforelse
            </tbody>
        </table>
    @endisset
    @isset($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endisset
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
