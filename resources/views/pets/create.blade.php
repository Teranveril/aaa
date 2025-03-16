<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Zwierzę</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Dodaj Zwierzę</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category_name" class="form-label">Kategoria - Nazwa:</label>
            <input type="text" class="form-control" id="category_name" name="category[name]">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoria - ID:</label>
            <input type="number" class="form-control" id="category_id" name="category[id]">
        </div>
        <div class="mb-3">
            <label for="photoUrls" class="form-label">Adresy URL zdjęć (po przecinku):</label>
            <input type="text" class="form-control" id="photoUrls" name="photoUrls">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tagi (nazwa, po przecinku):</label>
            <input type="text" class="form-control" id="tags" name="tags">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status">
                <option value="available">dostępny</option>
                <option value="pending">oczekujący</option>
                <option value="sold">sprzedany</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>
        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
