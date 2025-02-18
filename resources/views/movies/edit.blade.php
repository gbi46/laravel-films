<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Edit Movie</h1>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $movie->title }}" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $movie->description }}</textarea><br><br>

        <label for="poster">Poster:</label><br>
        <input type="file" id="poster" name="poster"><br><br>

        <label for="is_published">Published:</label><br>
        <input type="checkbox" id="is_published" name="is_published" value="1" {{ $movie->is_published ? 'checked' : '' }}><br><br>

        <label for="genres">Genres:</label><br>
        <select name="genres[]" id="genres" multiple>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $movie->genres->contains($genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>