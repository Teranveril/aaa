<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Zwierzę</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edytuj Zwierzę</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $pet['name'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label for="category_name" class="form-label">Kategoria - Nazwa:</label>
            <input type="text" class="form-control" id="category_name" name="category[name]" value="{{ $pet['category']['name'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoria - ID:</label>
            <input type="number" class="form-control" id="category_id" name="category[id]" value="{{ $pet['category']['id'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="photoUrls" class="form-label">Adresy URL zdjęć (po przecinku):</label>
            <input type="text" class="form-control" id="photoUrls" name="photoUrls" value="{{ implode(',', $pet['photoUrls'] ??) }}">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tagi (nazwa, po przecinku):</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{ implode(',', array_column($pet['tags'] ??, 'name')) }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status">
                <option value="available" {{ (isset($pet['status']) && $pet['status'] == 'available') ? 'selected' : '' }}>dostępny</option>
                <option value="pending" {{ (isset($pet['status']) && $pet['status'] == 'pending') ? 'selected' : '' }}>oczekujący</option>
                <option value="sold" {{ (isset($pet['status']) && $pet['status'] == 'sold') ? 'selected' : '' }}>sprzedany</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
