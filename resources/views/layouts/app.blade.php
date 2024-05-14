<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @yield('styles')
</head>

<body class="font-sans text-gray-800">
    <div id="app" class="flex flex-col md:flex-row" x-data="{open: false}">
        @auth
        <div class="md:hidden">
            <button @click="open = !open" class="fixed top-4 right-4 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open main menu</span>
                <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="md:hidden" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false"></div>
            <div class="fixed inset-0 flex z-40">
                <div class="flex-1 flex flex-col max-w-xs w-full bg-gray-800 text-white">
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center justify-between px-4">
                            <h2 class="text-2xl font-bold">IncubaTech</h2>
                            <button @click="open = false" class="text-gray-400 hover:text-white focus:outline-none">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-5 px-2 space-y-1">
                            <a href="{{ route('home') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-home mr-2"></i>
                                <span>Inicio</span>
                            </a>
                            <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-users mr-2"></i>
                                <span>Usuarios</span>
                            </a>
                            <a href="{{ route('clients.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-address-book mr-2"></i>
                                <span>Clientes</span>
                            </a>

    <div class="relative" x-data="{ incubationMenuOpen: false }">
    <button @click="incubationMenuOpen = !incubationMenuOpen" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
        Gestionar Incubaciones <i class="fas fa-caret-down ml-2"></i>
    </button>
    <div x-show="incubationMenuOpen" @click.away="incubationMenuOpen = false" class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="{{ route('incubation.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                <i class="fas fa-plus-circle mr-2"></i>Registro
            </a>
            <a href="{{ route('incubation.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                <i class="fas fa-list mr-2"></i>Listar
            </a>
        </div>
    </div>
</div>


                            <a href="{{ route('incubations_clients.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-egg mr-2"></i>
                                <span>Incubación</span>
                            </a>
                            <a href="{{ route('bitacoras.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-history mr-2"></i>
                                <span>Historial</span>
                            </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="hidden md:block bg-gray-800 text-white w-64 min-h-screen fixed left-0 top-0 p-4 shadow-md">
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">IncubaTech</h2>
                <p class="text-sm">Sistema de Control de Incubación</p>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-home mr-2"></i>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-users mr-2"></i>
                    <span>Usuarios</span>
                </a>
                <a href="{{ route('clients.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-address-book mr-2"></i>
                    <span>Clientes</span>
                </a>
                <div class="relative" x-data="{ incubationMenuOpen: false }">
    <button @click="incubationMenuOpen = !incubationMenuOpen" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
        Gestionar Incubaciones <i class="fas fa-caret-down ml-2"></i>
    </button>
    <div x-show="incubationMenuOpen" @click.away="incubationMenuOpen = false" class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="{{ route('incubation.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                <i class="fas fa-plus-circle mr-2"></i>Registro
            </a>
            <a href="{{ route('incubation.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                <i class="fas fa-list mr-2"></i>Listar
            </a>
        </div>
    </div>
</div>

                <a href="{{ route('incubations_clients.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-egg mr-2"></i>
                    <span>Incubación</span>
                </a>
                <a href="{{ url('/historial') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-history mr-2"></i>
                    <span>Historial</span>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Cerrar Sesión</span>
                </a>
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
