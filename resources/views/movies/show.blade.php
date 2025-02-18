<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie->title }}</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>{{ $movie->title }}</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('movies.edit', $movie->id) }}">Edit Movie</a>

    <p>Description: {{ $movie->description }}</p>
    <p>Published: {{ $movie->is_published ? 'Yes' : 'No' }}</p>

    <h2>Genres</h2>

    <ul>
        @foreach ($movie->genres as $genre)
            <li>{{ $genre->name }}</li>
        @endforeach
    </ul>

    @if ($movie->poster && $movie->poster !== 'default.jpg')
        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Movie Poster" style="max-width: 300px;">
    @else
        <img src="{{ asset('storage/movie_posters/default.jpg') }}" alt="Movie Poster" style="max-width: 300px;">
    @endif
</body>
</html>