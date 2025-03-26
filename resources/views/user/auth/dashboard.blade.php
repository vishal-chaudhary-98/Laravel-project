<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Dashboard </title>
        @include('headers.header')
        @vite('resources/css/app.css')
    </head>
    <body>
        @include('nav.nav')
        @if (session('success'))
        <span class="alert alert-success">
            {{ session('success') }}
        </span>
        @endif
        <div id="dashboard">
        <h1> Welcome {{ Auth::user()->name }} </h1>
        </div>
    </body>
</html>
