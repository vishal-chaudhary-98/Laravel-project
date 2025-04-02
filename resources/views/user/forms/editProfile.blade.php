<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit your personal details</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite ('resources/css/app.css')
    @include('headers.header')
</head>

<body>
    @if (session('success'))
    <div class="text-success">
        {{ session('success') }}
    </div>
    @elseif($errors->any())
        <!-- <ul> -->
            @foreach($errors->all() as $error)
            <!-- <li class="alert alert-danger"> -->

               <p class="text-danger"> {{ $error }}</p>
            <!-- </li> -->
            @endforeach
        <!-- </ul> -->
        @endif

    @auth
    @include('nav.nav')
    <div class="container mt-5">
        <div class="page-heading text-center mb-5"><h2>Edit profile</h2></div>
<form class="card p-5 edit-profile-form" method="post" action="{{ route('update/profile') }}" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" aria-describedby="nameHelp">
    <!-- <div id="nameHelp" class="form-text">Here you can add error or success message</div> -->
  </div>
  <div class="mb-3">
    <label for="uName" class="form-label">User Name</label>
    <input type="text" class="form-control" name="userName" value="{{ old('userName', $user->userName) }}" aria-describedby="uNameHelp">
    <!-- <div id="nameHelp" class="form-text">Here you can add error or success message</div> -->
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" aria-describedby="emailHelp">
    <!-- <div id="emailHelp" class="form-text">Here you can add error or success message</div> -->
  </div>
  <div class="mb-3">
    <label for="profile" class="form-label">Profile picture</label>
    <input type="file" class="form-control" name="profile" value="{{ old('profile', $user->profile_picture) }}" aria-describedby="profileHelp">
    <!-- <div id="profileHelp" class="form-text">Here you can add error or success message</div> -->
  </div>
  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
  <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Back</button>
</div>

</form>
</div>
<!-- @ else
<p class="text-danger">You must be logged in to access this form.</p> -->
@endauth

</body>
</html>
