<!DOCTYPE html>
<html>
<head>
    <title>Genres</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Genres</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('genres.create') }}">Create Genre</a>

    <ul>
        @foreach ($genres as $genre)
            <li>
                <a href="{{ route('genres.show', $genre->id) }}">{{ $genre->name }}</a>
                <a href="{{ route('genres.edit', $genre->id) }}">Edit</a>
                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>