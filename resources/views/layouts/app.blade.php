<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @yield('styles')
</head>
<body class="font-sans text-gray-800">
    <div id="app" class="flex flex-col md:flex-row" x-data="{open: false}">
        @auth
        <div class="md:hidden">
            <button @click="open = !open" class="fixed top-4 right-4 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open main menu</span>
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="md:hidden" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            <div class="fixed inset-0 flex z-40">
                <div class="flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button @click="open = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <nav class="px-2 space-y-1">
                            <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Usuarios</a>
                            <a href="{{ route('clients.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Clientes</a>
                            <a href="{{ route('incubation.create') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Registro</a>
                            <a href="{{ route('incubations_clients.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Incubación</a>
                            <a href="{{ url('/historial') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Historial</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Cerrar Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <aside class="hidden md:block bg-gray-100 w-64 min-h-screen fixed left-0 top-0 p-4 shadow-md">
            <nav class="space-y-2">
                <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Usuarios</a>
                <a href="{{ route('clients.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Clientes</a>
                <a href="{{ route('incubation.create') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Registro</a>
                <a href="{{ route('incubations_clients.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Incubación</a>
                <a href="{{ url('/historial') }}" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Historial</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 rounded-md hover:bg-gray-200 hover:text-blue-600 transition duration-300">Cerrar Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </aside>
        @endauth
        <main class="flex-1 p-4 md:ml-64">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
