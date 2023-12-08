<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Notes</title>
</head>
<body>
    <div class="header">
        <h1>User Notes</h1>
        <a href="{{ route('admin.logout') }}">Logout</a>
    </div>
    <h2>Notes</h2>
    <table border="2px solid">
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Status</th>
            <th>Change Status</th>
        </tr>
        @foreach($notes as $note)
        <tr>
            <td>{{ $note->title }}</td>
            <td>{{ $note->content }}</td>
            <td>{{ date('Y-m-d', strtotime($note->created_at)) }}</td>
            <td>{{ date('Y-m-d', strtotime($note->updated_at)) }}</td>
            <td>
                @if ($note->status == null)
                    <p>Unpublished</p>
                    @else
                    <p>Published</p>
                @endif
            </td>
            <td>
                
                <form action="{{ route('publisher.changeStatus', $note->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($note->status == null)
                        <button type="submit" class="btn">Publish</button>
                        @else
                        <button type="submit" class="btn">Unpublish</button>
                    @endif
                </form>                
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('publisher.dashboard') }}">Back to Dashboard</a>
</body>
</html>