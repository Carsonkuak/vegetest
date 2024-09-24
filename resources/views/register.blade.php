<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Form</title>
</head>
<body>
<form action="{{ Route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email">Email address:</label>
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
        {{-- <div class="mb-3">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            @error('confirm_password')
            <p class="error">{{ $message }}</p>
            @enderror
        </div> --}}
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <button><a href="{{ Route('login') }}">Alrealy has a account?Login here</a></button>
</body>
</html>
