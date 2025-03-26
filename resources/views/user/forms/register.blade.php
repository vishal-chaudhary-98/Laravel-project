<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
    @include('headers.header')
</head>
<body>
    @include('nav.nav')

    <!-- Defining success and error messages -->
    <div class="success-error">
        @if (session('success'))
        <span class="alert alert-success">
            {{ session('success') }}
        </span>
        @elseif ($errors->any())
        <ul>
            @foreach($errors->all as $error)
            <li class="alert alert-danger">
                {{ $error }}
            </li>
            @endforeach
        </ul>
        @endif
    </div>
    <!-- Defining success and error messages -->

    <div class="container mt-5">
        <form class="custom-form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nameHelp" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" aria-describedby="nameHelp">
                @error('name')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">User name</label>
                <input type="text" name="userName" class="form-control" value="{{ old('userName') }}" aria-describedby="userNameHelp">
                @error('userName')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" aria-describedby="emailHelp">
                <div value="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile picture</label>
                <input type="file" name="profile_picture" class="form-control">
                <div class="form-text">Optional.</div>
            </div>

            <div class="mb-3">
                <label for="password1" class="form-label">Password</label>
                <input type="password" name="pswd" class="form-control">
                @error('pswd')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="pswd_confirmation" class="form-control">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" value="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <p>Already a user? <a href="/login"> Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>
