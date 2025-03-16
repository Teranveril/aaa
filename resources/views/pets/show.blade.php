<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły Zwierzęcia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Szczegóły Zwierzęcia</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pet['name'] ?? 'Brak nazwy' }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $pet['id'] ?? 'Brak' }}</p>
            @isset($pet['category'])
                <p class="card-text"><strong>Kategoria:</strong> {{ $pet['category']['name'] ?? 'Brak' }} (ID: {{ $pet['category']['id'] ?? 'Brak' }})</p>
            @endisset
            @isset($pet['photoUrls'])
                <p class="card-text"><strong>Zdjęcia:</strong>
                <ul>
                    @foreach ($pet['photoUrls'] as $url)
                        <li><a href="{{ $url }}" target="_blank">{{ $url }}</a></li>
                    @endforeach
                </ul>
                </p>
            @endisset
            @isset($pet['tags'])
                <p class="card-text"><strong>Tagi:</strong>
                <ul>
                    @foreach ($pet['tags'] as $tag)
                        <li>{{ $tag['name'] ?? 'Brak' }}</li>
                    @endforeach
                </ul>
                </p>
            @endisset
            <p class="card-text"><strong>Status:</strong> {{ $pet['status'] ?? 'Brak' }}</p>
            <a href="{{ route('pets.index') }}" class="btn btn-secondary">Powrót do listy</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
