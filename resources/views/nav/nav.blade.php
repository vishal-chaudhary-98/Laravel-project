<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Practice</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            @guest
            <div class="d-flex align-items-center   login">
                <a class="admin-btn" type="submit" href="/admin">Admin</a>
                <a class="btn btn-outline-success" type="submit" href="/user/login">Login</a>
            </div>
            @endguest
            @auth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/user/dashboard">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- User profile picture (circle) -->
                        @if(auth()->check())
                        <img src="{{ auth()->user()->profile_picture ? asset('profiles/' . auth()->user()->profile_picture) : asset('uploads/1.jpg') }}" class="rounded-circle" alt="User Profile Picture" width="40" height="40">
                        @else
                        <img src="{{ asset('uploads/1.jpg') }}" class="rounded-circle" alt="Default Profile Picture" width="40" height="40">
                        @endif


                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <p class="text-center">{{ auth()->user()->name }}</p>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('edit/profile') }}">Edit personal details</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Change name</a></li> -->
                        <li><a class="dropdown-item" href="{{ route('change/password') }}">Edit password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/user/logout" method="post">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth

        </div>
</nav>
