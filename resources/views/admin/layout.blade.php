<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
                <p class="text-indigo-200">Espace Administrateur</p>
            </div>
            <nav class="mt-6">
                <x-admin-nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories*')">
                    Catégories
                </x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.contents.index') }}" :active="request()->routeIs('admin.contents*')">
                    Contenus
                </x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.media.index') }}" :active="request()->routeIs('admin.media*')">
                    Médias
                </x-admin-nav-link>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-indigo-600 hover:text-indigo-900">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>