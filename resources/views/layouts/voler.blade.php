<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
</head>
<body>
<div id="app">
    @section('sidebar')
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('images/logo.svg') }}" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class='sidebar-title'>Menu</li>


                        <li class="sidebar-item  ">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Home</span>
                            </a>

                        </li>


                        <li class="sidebar-item  ">
                            <a href="{{ route('addpage') }}" class='sidebar-link'>
                                <i data-feather="file-plus" width="20"></i>
                                <span>Add server</span>
                            </a>

                        </li>


                        {{--<li class="sidebar-item  has-sub">
                             <a href="#" class='sidebar-link'>
                                 <i data-feather="layers" width="20"></i>
                                 <span>Games</span>
                             </a>

                             <ul class="submenu ">

                                 @foreach($games as $game)
                                     <li>
                                         <a href="component-alert.html">{{ $game['name'] }}</a>
                                     </li>
                                 @endforeach
                                 <li>
                                     <a href="component-alert.html">Alert</a>
                                 </li>

                                 <li>
                                     <a href="component-badge.html">Badge</a>
                                 </li>

                                 <li>
                                     <a href="component-breadcrumb.html">Breadcrumb</a>
                                 </li>

                                 <li>
                                     <a href="component-buttons.html">Buttons</a>
                                 </li>

                                 <li>
                                     <a href="component-card.html">Card</a>
                                 </li>

                                 <li>
                                     <a href="component-carousel.html">Carousel</a>
                                 </li>

                                 <li>
                                     <a href="component-dropdowns.html">Dropdowns</a>
                                 </li>

                                 <li>
                                     <a href="component-list-group.html">List Group</a>
                                 </li>

                                 <li>
                                     <a href="component-modal.html">Modal</a>
                                 </li>

                                 <li>
                                     <a href="component-navs.html">Navs</a>
                                 </li>

                                 <li>
                                     <a href="component-pagination.html">Pagination</a>
                                 </li>

                                 <li>
                                     <a href="component-progress.html">Progress</a>
                                 </li>

                                 <li>
                                     <a href="component-spinners.html">Spinners</a>
                                 </li>

                                 <li>
                                     <a href="component-tooltips.html">Tooltips</a>
                                 </li>

                             </ul>

                        </li>--}}


                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
    @show
    <div id="main">
        <nav class="navbar navbar-header navbar-expand navbar-light">
            <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
            <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                    {{--<li class="dropdown nav-icon">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-lg-inline-block">
                                <i data-feather="bell"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                            <h6 class='py-2 px-4'>Notifications</h6>
                            <ul class="list-group rounded-none">
                                <li class="list-group-item border-0 align-items-start">
                                    <div class="avatar bg-success me-3">
                                        <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                    </div>
                                    <div>
                                        <h6 class='text-bold'>New Order</h6>
                                        <p class='text-xs'>
                                            An order made by Ahmad Saugi for product Samsung Galaxy S69
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown nav-icon me-2">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-lg-inline-block">
                                <i data-feather="mail"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                            <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a>
                            <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                        </div>
                    </li>--}}
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
                            <a class="dropdown-item" href="https://steamcommunity.com/profiles/{{ $user['steam_id'] }}"><i data-feather="user"></i> Account</a>
                            {{--<a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                            <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>--}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                        </div>
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
</div>
@section('scripts')
    <script src="{{ mix('js/app.min.js') }}"></script>
    <script src="{{ mix('js/main.min.js') }}"></script>
    <script src="{{ mix('js/vendor/feather-icons.min.js') }}"></script>
    <script src="{{ mix('js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ mix('js/vendor/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
@show
</body>
</html>
