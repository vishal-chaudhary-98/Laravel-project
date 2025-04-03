<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard </title>
    @include('headers.header')
    @include('admin.admin_headers.admin_headers')

    @vite('resources/css/app.css')
</head>

<body>
    <!-- @ include('nav.nav') -->
    @include('admin.nav.admin_nav')
    @if (session('success'))
    <span class="alert alert-success">
        {{ session('success') }}
    </span>
    @endif
    <div id="dashboard">
        <h1> Welcome {{ Auth::guard('admin')->user()->admin_id  }} </h1>
    </div>

    @include('admin.admin_headers.admin_scripts')
</body>
</html>
