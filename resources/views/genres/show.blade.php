<!DOCTYPE html>
<html>
<head>
    <title>{{ $genre->name }}</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>{{ $genre->name }}</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('genres.edit', $genre->id) }}">Edit Genre</a>

    <h2>Movies</h2>

    <a href="{{ route('genres.movies.create', $genre->id) }}">Create Movie</a>

    <ul>
        @foreach ($genre->movies as $movie)
            <li>{{ $movie->title }}</li>
        @endforeach
    </ul>
</body>
</html>