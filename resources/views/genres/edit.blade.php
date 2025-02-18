<!DOCTYPE html>
<html>
<head>
    <title>Edit Genre</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Edit Genre</h1>

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $genre->name }}" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>