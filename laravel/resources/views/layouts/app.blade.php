<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">


        <div class="navbar bg-base-100">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>

                </div>
                <a class="btn btn-ghost normal-case text-xl" href="/">PinjamBlok</a>
            </div>
            <div class="navbar-center lg:flex">
                <ul class="menu menu-horizontal px-1">


                    <li><a href="{{ route('room.index') }}">Rooms</a></li>
                    <li><a href="{{ route('item.index') }}">Items</a></li>
                    <li><a href="{{ route('transact.index') }}">Transactions</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <a class="btn warning-content" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-6 px-6">

                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
<footer class="footer footer-center p-4 bg-base-300 text-base-content">
    <div>
        <p>Copyright © 2023 - All right reserved by MFirdausAmran</p>
    </div>
</footer>

</html>
