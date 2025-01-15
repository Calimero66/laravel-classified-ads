@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Config;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Config::get('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="h-full">
    <div id="app">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    {{-- Primary Navigation --}}
                    <div class="flex">
                        <div class="flex space-x-8">
                            <a href="{{ route('advertisement.index') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ Route::is('advertisement.index') ? 'text-gray-900 border-b-2 border-indigo-500' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Classifieds Board
                            </a>

                            @auth
                                <a href="{{ route('advertisement.admin') }}"
                                    class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ Route::is('advertisement.admin') ? 'text-gray-900 border-b-2 border-indigo-500' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                    My Ads
                                </a>
                            @endauth

                            <a href="{{ route('advertisement.create') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ Route::is('advertisement.create') ? 'text-gray-900 border-b-2 border-indigo-500' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Post Ad
                            </a>
                        </div>
                    </div>

                    {{-- User Navigation --}}
                    <div class="flex items-center">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Login</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 text-sm text-gray-700 hover:text-gray-900">Register</a>
                            @endif
                        @else
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                    role="menu">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left"
                                            role="menuitem">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="py-4">
            @if (Session::has('message') && Session::has('message_type'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="alert alert-{{ Session::get('message_type') }} mb-4">
                        {{ Session::get('message') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Alpine.js for dropdown functionality --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>