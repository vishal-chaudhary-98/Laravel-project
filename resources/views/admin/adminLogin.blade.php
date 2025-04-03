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
@include('admin.admin_headers.admin_headers')

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
        <ul>
            @foreach($errors->all() as $error)
            <li class="alert alert-danger">
                {{ $error }}
            </li>
            @endforeach
        </ul>
        @endif
    </div>
    <!-- End success and error messages -->

    <div class="container mt-5">
        <form class="custom-form" method="post" action="{{ route('admin_login') }}">
            @csrf
            <div class="mb-3">
                <label for="userName" class="form-label">Admin ID</label>
                <input type="text" name="admin_id" class="form-control" value="{{ old('userName') }}">
                @error('admin_id')
                <span class="alert text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="admin_password" class="form-control">
                @error('pswd')
                <span class="alert text-danger">{{ $message }} </span>
                @enderror
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
