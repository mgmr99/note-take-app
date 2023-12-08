<!DOCTYPE html>
<html>
<head>
    <title>Note Taking App</title>
    <style>
        /* CSS styles for the note-taking app */
        body {
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2px;
        }
        
        .note {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .displayNote {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 2px;
            margin-bottom: 10px;
        }
        
        .note textarea {
            width: 100%;
            height: 100px;
            resize: none;
            border: none;
            outline: none;
        }
        
        .note button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
        .btn{
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
        .logout-btn{
            text-align: right;
        }

    </style>
</head>
<body>
    <div class="container">        
        <div class="logout-btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn">Logout</button>
            </form> 
        </div>    
        <h1>ADD YOUR NOTES</h1> 
        <form action="/create-note" method="post">
            @csrf
            <div class="note"> 
                <input type="text" name="title" placeholder="Enter your title here">
            </div>
            <div class="note">
                <textarea name="content" placeholder="Enter your note here"></textarea>
            </div>          
            <button type="submit">Add Note</button>
        </form>     
    </div>
    <div class="container">
        <h1>{{ $username }}'s Notes</h1>
        @foreach($notes as $note)
            <div class="displayNote">
                <h2>Title: {{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
                <h6>Created By: {{ $username }}</h6>
                <h6>Created At: {{ $note->created_at }}</h6>

                <p class="edit-btn"><a href="/edit-note/{{ $note->id }}">Edit</a></p>
                
                <form action="/delete-note/{{ $note->id }}" method="post">
                    @csrf
                    @METHOD('DELETE')
                    <input type="hidden" name="note_id" value="{{ $note->id }}">
                    <button type="submit">Delete Note</button>
                </form>
            </div>
        @endforeach
</body>
</html>
