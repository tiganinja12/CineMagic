<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Department of Computer Engineering')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts AND CSS Files -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-800">
        <!-- Navigation Menu -->
        <nav class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}">
                                <div class="h-16 w-40 bg-cover bg-[url('../img/politecnico_h.svg')] dark:bg-[url('../img/politecnico_h_white.svg')]"></div>
                            </a>
                        </div>
                    </div>
                    <div id="menu-container" class="grow flex flex-col sm:flex-row items-stretch
                    invisible h-0 sm:visible sm:h-auto">
                        <!-- Menu Item: Courses -->
                        <x-menus.menu-item
                            content="Movies"
                            selectable="1"
                            href="{{ route('movies.showcase') }}"
                            selected="{{ Route::currentRouteName() == 'movies.showcase'}}"
                        />

                        <div class="grow"></div>

                        <!-- Menu Item: Cart -->
                        @if (session('cart'))
                            @can('use-cart')
                            <x-menus.cart
                                :href="route('cart.show')"
                                selectable="1"
                                selected="{{ Route::currentRouteName() == 'cart.show'}}"
                                :total="session('cart')->count()"/>
                            @endcan
                        @endif

                        {{-- If user has any of the 4 menu options previlege, then it should show the submenu --}}
                        @if(
                            //Gate::check('viewAny', App\Models\Student::class) ||
                            Gate::check('viewAny', App\Models\User::class) ||
                            //Gate::check('viewAny', App\Models\Department::class) ||
                            Gate::check('viewAny', App\Models\Movie::class)
                        )
                        <x-menus.submenu
                        selectable="0"
                        uniqueName="submenu_others"
                        content="More">
                            @can('viewAny', App\Models\User::class)
                            <x-menus.submenu-item
                                content="Administratives"
                                selectable="0"
                                href="{{ route('administratives.index') }}" />
                            @endcan
                            <hr>
                            @can('viewAny', App\Models\Course::class)
                            <x-menus.submenu-item
                                content="Course Management"
                                href="{{ route('courses.index') }}"/>
                            @endcan
                    </x-menus.submenu>
                    @endif

                        @auth
                        <x-menus.submenu selectable="0" uniqueName="submenu_user">
                            <x-slot:content>
                                <div class="pe-1">
                                    <img src="{{ Auth::user()->photoFullUrl}}" class="w-11 h-11 min-w-11 min-h-11 rounded-full">
                                </div>
                                {{-- ATENÇÃO - ALTERAR FORMULA DE CALCULO DAS LARGURAS MÁXIMAS QUANDO O MENU FOR ALTERADO --}}
                                <div class="ps-1 sm:max-w-[calc(100vw-39rem)] md:max-w-[calc(100vw-41rem)] lg:max-w-[calc(100vw-46rem)] xl:max-w-[34rem] truncate">
                                    {{ Auth::user()->name }}
                                </div>
                            </x-slot>
                            @can('viewMy', App\Models\Discipline::class)
                            <x-menus.submenu-item
                                content="My Disciplines"
                                selectable="0"
                                href="{{ route('disciplines.my') }}"/>
                            @endcan
                            @can('viewMy', App\Models\Teacher::class)
                            <x-menus.submenu-item
                                content="My Teachers"
                                selectable="0"
                                href="{{ route('teachers.my') }}"/>
                            @endcan
                            @can('viewMy', App\Models\Student::class)
                                <x-menus.submenu-item
                                    content="My Students"
                                    selectable="0"
                                    href="{{ route('students.my') }}"/>
                                <hr>
                            @endcan
                            <hr>
                            <form id="form_to_logout_from_menu" method="POST" action="{{ route('logout') }}" class="hidden">
                                @csrf
                            </form>
                            <x-menus.submenu-item
                                content="Log Out"
                                selectable="0"
                                form="form_to_logout_from_menu"/>
                        </x-menus.submenu>
                        @else
                        <!-- Menu Item: Login -->
                        <x-menus.menu-item
                            content="Login"
                            selectable="1"
                            href="{{ route('login') }}"
                            selected="{{ Route::currentRouteName() == 'login'}}"
                            />
                        @endauth
                    </div>
                    <!-- Hamburger -->
                    <div class="absolute right-0 top-0 flex sm:hidden pt-3 pe-3 text-black dark:text-gray-50">
                        <button id="hamburger_btn">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path id="hamburger_btn_open" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path class="invisible" id="hamburger_btn_close" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white dark:bg-gray-900 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h4 class="mb-1 text-base text-gray-500 dark:text-gray-400 leading-tight">
                    Department of Computer Engineering
                </h4>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    @yield('header-title')
                </h2>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @if (session('alert-msg'))
                    <x-alert type="{{ session('alert-type') ?? 'info' }}">
                        {!! session('alert-msg') !!}
                    </x-alert>
                @endif
                @if (!$errors->isEmpty())
                        <x-alert type="warning" message="Operation failed because there are validation errors!"/>
                @endif
                @yield('main')
            </div>
        </main>
    </div>
</body>

</html>
