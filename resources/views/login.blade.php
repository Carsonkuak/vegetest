<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
</head>
<style>
    body{
        text-align: center;
        align-items: center;
    }
</style>
<body>
    <form action="{{ Route('login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Login</button>
    </form>
    <button><a href="{{ Route('register') }}">Doesn't has account? Register here</a></button>
</body>
</html>
