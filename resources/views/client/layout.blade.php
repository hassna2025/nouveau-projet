<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/child-theme.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('client.categories') }}" class="flex items-center">
                    <span class="text-2xl mr-2">👧🏽</span>
                    <span class="text-xl font-bold text-indigo-600">{{ config('app.name') }}</span>
                </a>
                
                <nav class="flex items-center space-x-6">
                    @auth
                    <a href="{{ route('client.profile.show') }}" class="text-gray-600 hover:text-indigo-600">
                        Mon profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-indigo-600">Déconnexion</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Inscription
                    </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
            </p>
        </div>
    </footer>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/child-interaction.js') }}"></script>
    @stack('scripts')
</body>
</html>