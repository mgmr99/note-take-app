
<!DOCTYPE html>
<html>
<head>
    <title>Publisher Dashboard</title>
    <style>
    </style>
</head>
<body>
    <div class="header">
        <h1>Hello,{{ $publishername }}</h1>
        <h2>Your Publisher Dashboard</h2>
        <a href="{{ route('publisher.logout') }}">Logout</a>
    </div>
    <h2>Users</h2>
    {{-- {{ dd($users) }} --}}
    <table border="2px solid">  
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Notes Count</th>
            <th>User Notes</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
            <td>
                {{-- @if($user->notes->count()>0)
                    <p>{{ $user->notes->count() }}</p>
                    @else
                        <p>No Notes</p>
                @endif --}}
                5
            </td>
            <td> 
                
                <form action="{{ route('publisher.userNotes', $user->id) }}" method="POST">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn">Publish/Unpublish Notes</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    
</body>
</html>
