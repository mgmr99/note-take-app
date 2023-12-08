<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Note</title>
</head>
<body>
    <div class="container">
        <h1>Edit Note</h1>
        <form action="{{ route('admin.updateNotes', $note->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3>Title</h3>
            <input type="text" name="title" value="{{ $note->title }}"><br>
            <h3>Content</h3>
            <textarea name="content">{{ $note->content }}</textarea>
            <button type="submit">Update Note</button>
            </div>
        <a href="/">Back to Notes</a>
    </div>
</body>
</html>