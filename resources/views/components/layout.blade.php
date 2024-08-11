<!doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48;
            font-size: 2rem;
            color: white;
        }
    </style>
</head>

<body class="h-full">
<div class="min-h-full flex flex-col">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if (Auth::check())
                            <a href="/home"><span class="material-symbols-outlined">account_balance</span></a>
                        @else
                            <a href="/"><span class="material-symbols-outlined">account_balance</span></a>
                        @endif
                    </div>
                </div>

                @if (Auth::check())
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <x-nav-link href="/transfer">Transactions</x-nav-link>
                            <x-nav-link href="/crypto">Crypto</x-nav-link>
                        </div>
                    </div>
                @endif

                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6 space-x-4">
                        @guest
                            <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                            <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                        @endguest

                        @auth
                            <form method="POST" action="/logout">
                                @csrf
                                <x-form-button>Log Out</x-form-button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
        </div>
    </header>

    <main class="flex-grow">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
    <footer class="bg-gray-800 text-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-sm">&copy; {{ date('Y') }} Bank.</p>
        </div>
    </footer>
</div>

</body>

</html>
