<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite ('resources/css/app.css')
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
        @elseif($errors->any())
        <!-- <ul> -->
            @foreach($errors->all() as $error)
            <!-- <li class="alert alert-danger"> -->

               <p class="text-danger"> {{ $error }}</p>
            <!-- </li> -->
            @endforeach
        <!-- </ul> -->
        @endif
    </div>
    <!-- End success and error messages -->

    <div class="container mt-5">
        <form class="custom-form" method="post" action="{{ route('user.login') }}">
            @csrf
            <div class="mb-3">
                <label for="userName" class="form-label">User name</label>
                <input type="text" name="userName" class="form-control" value="{{ old('userName') }}" aria-describedby="userNameHelp">
                @error('userName')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
                @error('pswd')
                <span class="alert text-danger">{{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="d-flex  justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <p>If you are a new user <a href="/register"> Register here</a></p>
            </div>
        </form>
    </div>
</body>

</html>
