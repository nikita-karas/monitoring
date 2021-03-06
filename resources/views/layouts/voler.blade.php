<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ mix('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="nav-icon me-2" href="{{ route('home') }}">
            <div class="d-lg-inline-block">
                <i data-feather="home"></i>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                @if ($user)
                    <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="avatar me-1">
                                <img src="{{ $user['avatar_small'] }}" alt="" srcset="">
                            </div>
                            <div class="d-none d-md-block d-lg-inline-block">Hi, {{ $user['name'] }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item"
                               href="{{ route('profile') }}"><i
                                    data-feather="user"></i>Profile</a>
                            <a class="dropdown-item"
                               href="https://steamcommunity.com/profiles/{{ $user['steam_id'] }}"><i
                                    data-feather="user"></i>Steam profile</a>
                            <a class="dropdown-item"
                               href="{{ route('server.add.page') }}"><i
                                    data-feather="plus-circle"></i>Add server</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i>
                                Logout</a>
                        </div>
                    </li>
                @else
                    <li class="dropdown nav-icon me-2 text-center">
                        <a href="{{ route('login') }}">
                            <div class="d-lg-inline-block">
                                <i data-feather="log-in"></i>
                            </div>
                            <div class="text-xs">Sign-in</div>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="main-content container-fluid">
        <section class="section">
            @yield('content')
        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2020 &copy; Voler</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                        href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
            </div>
        </div>
    </footer>
</div>
@section('scripts')
    <script src="{{ mix('js/app.min.js') }}"></script>
    <script src="{{ mix('js/main.min.js') }}"></script>
    <script src="{{ mix('js/vendor/feather-icons.min.js') }}"></script>
@show
</body>
</html>
