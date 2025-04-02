<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change your password</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite ('resources/css/app.css')
    @include('headers.header')
</head>

<body>
    @auth
    @include('nav.nav')
    <div class="container mt-5">
        <div class="page-heading text-center mb-5"><h2>Change password</h2></div>
<form class="card p-5 edit-profile-form" method="post" action="#" >
  <div class="mb-3">
    <label for="current-pswd" class="form-label">Current password</label>
    <input type="password" class="form-control" name="current-pswd" aria-describedby="current-pswdHelp">
    <div id="current-pswdHelp" class="form-text">You must have to fill your previous password first!</div>
  </div>
  <div class="mb-3">
    <label for="new-pswd" class="form-label">New password</label>
    <input type="password" class="form-control" name="new-pswd" aria-describedby="new-pswdHelp">
    <!-- <div id="new-pswdHelp" class="form-text">Here you can add error or success message</div> -->
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
