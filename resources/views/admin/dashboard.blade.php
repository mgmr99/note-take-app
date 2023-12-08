
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
    </style>
</head>
<body>
    <div class="header">
        <h1>Hello,{{ $adminname }}</h1>
        <h2>Your Admin Dashboard</h2>
        <a href="{{ route('admin.logout') }}">Logout</a>
    </div>
    <h2>Users</h2>
    {{-- {{ dd($users) }} --}}
    <table border="2px solid">  
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Delete</th>
            <th>Roles</th>
            <th>User Notes</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
            <td>         
                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Delete User</button>
                </form>
            </td>
            <td>
                <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST">
                    @csrf     
                    @method('PUT')          
                        <button type="submit" class="btn">Make/Remove Admin</button>
                </form>
            </td>
            <td> 
                <form action="{{ route('admin.userNotes', $user->id) }}" method="POST">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn">See User Notes</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    
</body>
</html>
