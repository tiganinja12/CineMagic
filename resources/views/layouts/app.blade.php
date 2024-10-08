<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 🦦 Cinemagic - @yield('title') !</title>
    <link rel="icon" type="image/x-icon" href="storage/favicon.ico">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">


    <!-- Flowbite CSS -->

    <link rel="preload" href="http://[::1]:5173/node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        a {
            text-decoration: none !important;
            margin: 3px;
        }

        #doido {
            position: absolute;
            width: 100%;
            bottom: 0;
            list-style-type: none;
            left: -15%;
            padding-bottom: 1.25rem;
        }

        #doido2 {
            position: absolute;
            width: 78%;
            bottom: 0;
            list-style-type: none;

            padding-bottom: 1.25rem;
        }

        .back-cinema {
            background-image: url('https://images.unsplash.com/photo-1475257026007-0753d5429e10?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8ZGFyayUyMGxlYWZ8ZW58MHx8MHx8&w=1000&q=80');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        body {
            background-color: #111827;
            color: #fff; /* Ensure text color is white */
        }

        select.form-control, input.form-control {
            color: #000; /* Set input and select text color to black */
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .page-link {
            border: none;
            color: white;
            margin: 0;
            background-color: #1E293B; //your color
            border-color: #1E293B; //your color

        }

        .page-link:hover {
            color: white;
            border: none;
            background-color: #FB923C; //your color
            border-color: #FB923C; //your color
        }

        .page-item.active .page-link {
            border: none;
            color: white;
            background-color: #FB923C; //your color
            border-color: #1E293B;
            margin: 0;

        }

        .page-item.disabled .page-link {
            border: none;
            color: white;
            background-color: #1E293B; //your color
            border-color: #1E293B;
            margin: 0;

        }

        .modal-body label[for="nif"], .modal-body label[for="payment_ref"], .modal-body label[for="payment_type"] {
                        color: black !important;
                    }

                    /* Ensures input text for NIF and payment reference is black */
                    .modal-body #nif, .modal-body #payment_ref {
                        color: black !important;
                    }
    </style>
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Cinemagic') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->photo_filename)
                                        <img src="{{ asset('storage/photos/' . Auth::user()->photo_filename) }}" alt="Profile Picture" class="rounded-circle" width="30" height="30" style="margin-right: 8px;">
                                    @else
                                        <img src="{{ asset('storage/photos/default.png') }}" alt="Profile Picture" class="rounded-circle" width="30" height="30" style="margin-right: 8px;">
                                    @endif

                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->type === 'C' || Auth::user()->type === 'A')
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            {{ __('Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('statistics.index') }}">Statistics</a>
                                    @endif
                                    @if (Auth::user()->type === 'C')
                                        <a class="dropdown-item" href="{{ route('purchases.show', Auth::user()->id) }}">
                                            Historico de Compras
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('password.change') }}">
                                        Change Password
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <a href="{{ route('carrinho.index') }}"
                            class="flex h-10 flex-col items-center justify-center rounded-md p-2 text-slate-200 transition hover:text-orange-400"
                            style="text-decoration: none;">

                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
