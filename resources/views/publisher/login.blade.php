
<!DOCTYPE html>
<html>
<head>
    <title>Publisher Login</title>
    <style>
        body {
            background-color: #3f3636;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding:  20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #1e271e;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .form-group button:hover {
            background-color: #45a049;
        }
        .invalid-feedback{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">       
        <h2>Publisher Login</h2>
    @if ($errors->has('matcherror'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('matcherror') }}</strong>
        </span>
    @endif
        <form action="{{ route('publisher.login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
