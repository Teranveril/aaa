<!DOCTYPE html>
<html>
<head>
    <title>Pets</title>
</head>
<body>
<h1>Lista Zwierząt</h1>
<ul>
    @foreach ($pets as $pet)
        <li>
            {{ $pet['name'] ?? 'Brak nazwy' }} -
            ID: {{ $pet['id'] ?? 'Brak ID' }}
        </li>
    @endforeach
</ul>
</body>
</html>
