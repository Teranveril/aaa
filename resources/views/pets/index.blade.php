<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pets</title>
</head>
<body>
<h1>Lista Zwierząt</h1>
<ul>
    @foreach ($pets as $pet)
        <li>{{ $pet['name'] }} - {{ $pet['status'] }}</li>
    @endforeach
</ul>
</body>
</html>
