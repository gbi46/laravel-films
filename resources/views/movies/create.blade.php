<!DOCTYPE html>
<html>
<head>
    <title>Create Movie</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Create Movie</h1>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="poster">Poster:</label><br>
        <input type="file" id="poster" name="poster"><br><br>

        <label for="is_published">Published:</label><br>
        <input type="checkbox" id="is_published" name="is_published" value="1"><br><br>

        <label for="genres">Genres:</label><br>
        <select name="genres[]" id="genres" multiple>
            @foreach ($genres as $availableGenre)
                <option value="{{ $availableGenre->id }}"
                    @if (isset($genre) && $availableGenre->id === $genre->id)
                        selected
                    @endif
                >
                    {{ $availableGenre->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>