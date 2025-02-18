<!DOCTYPE html>
<html>
<head>
    <title>Create Genre</title>
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Home</a>
    </header>
    <h1>Create Genre</h1>

    <form action="{{ route('genres.store') }}" method="POST">
        @csrf

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>