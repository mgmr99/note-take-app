<!DOCTYPE html>
<html>
<head>
    <title>Note App</title>
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
                <button type="submit" class="btn" onclick="window.location.href='/register  ';">Register</button>
        </div>    
        <div class="logout-btn">
                <button type="submit" class="btn" onclick="window.location.href='/login';">Login</button>
        </div>    
        <h1>Published NOTES</h1> 
    <div class="container">
        @foreach($notes as $note)
            <div class="displayNote">
                <h2>Title: {{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
                {{-- <h6>Created By: {{ $username }}</h6> --}}
                <h6>Created At: {{ $note->created_at }}</h6>
            </div>
        @endforeach
</body>
</html>
