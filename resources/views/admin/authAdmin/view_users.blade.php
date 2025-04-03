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
    <!-- Main content  -->
    <div class="container-fluid">
        <div class="row">
            @include('admin.nav.left_nav')
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">All users</h5>
                            <div class="card-body">
                                <div class="table-responsive">




















                                <table class="table">
    <thead>
        <tr>
            <th scope="col">Sr.no</th>
            <th scope="col">Name</th>
            <th scope="col">User name</th>
            <th scope="col">Email</th>
            <th scope="col">Profile picture</th>
            <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($users->count() > 0)
            @foreach ($users as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->userName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->profile_picture)
                            <img src="{{ asset('profiles/' . $user->profile_picture) }}"
                                 alt="Profile Picture"
                                 width="40"
                                 class="rounded-circle">
                        @else
                            No Image
                        @endif
                    </td>
                    <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                    <form action="#" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <td>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                Delete
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">No users found.</td>
            </tr>
        @endif
    </tbody>
</table>


















                                </div>
                                @if($users->count() > 0 )
                                <a href="#" class="btn btn-block btn-light">View all</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-xl-4">
                        <div class="card">
                            <h5 class="card-header">Traffic last 6 months</h5>
                            <div class="card-body">
                                <div id="traffic-chart"></div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- Footer  -->
                @include('admin.nav.footer')
            </main>


        </div>
    </div>

    @include('admin.admin_headers.admin_scripts')
</body>

</html>
