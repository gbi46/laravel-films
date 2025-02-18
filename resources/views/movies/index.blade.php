<!DOCTYPE html>
<html>
<head>
    <title>Movies</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Movies</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach ($movies as $movie)
            <li>
                <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
                <a href="{{ route('movies.edit', $movie->id) }}">Edit</a>

                @if ($movie->is_published)
                    <span style="color: green;">Published</span>
                @else
                    <span style="color: red;">Not Published</span>
                    <form action="{{ route('movies.publish', $movie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Publish</button>
                    </form>
                @endif

                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    {{ $movies->links() }}
</body>
</html>