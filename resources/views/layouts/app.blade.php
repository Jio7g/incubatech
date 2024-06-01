<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Enlace a la hoja de estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Enlace a la hoja de estilos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Enlace al script de Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Sección para incluir estilos adicionales específicos de cada página -->
    @yield('styles')
</head>

<body class="font-sans text-gray-800 bg-gray-100">
    <div id="app" class="flex" x-data="{open: window.innerWidth > 768}">
        @auth
        <!-- Menú lateral -->
        <aside class="bg-gray-800 text-white w-64 min-h-screen fixed md:static transform transition-transform duration-300 ease-in-out z-50" :class="{'translate-x-0': open, '-translate-x-full': !open}">
            <!-- Encabezado del menú -->
            <div class="flex items-center justify-between px-6 py-4 bg-gray-900">
                <h2 class="text-2xl font-bold">IncubaTech</h2>
                <button @click="open = !open" class="md:hidden focus:outline-none">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Enlaces del menú -->
            <nav class="mt-8 px-6 space-y-2">
                <!-- Inicio -->
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-home mr-2"></i>
                    <span class="text-lg">Inicio</span>
                </a>

                <!-- Usuarios (solo para SuperUsuario y Administrador) -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador')
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-users mr-2"></i>
                    <span class="text-lg">Usuarios</span>
                </a>
                @endif

                <!-- Clientes -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'Usuario')
                <a href="{{ route('clients.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-address-book mr-2"></i>
                    <span class="text-lg">Clientes</span>
                </a>
                @endif

                <!-- Menú desplegable para gestionar incubaciones -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'Usuario')
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-white rounded-md hover:bg-gray-700 focus:outline-none transition duration-300">
                        <div class="flex items-center">
                            <i class="fas fa-egg mr-2"></i>
                            <span class="text-lg">Gestión de Incubaciones</span>
                        </div>
                        <i class="fas fa-chevron-down ml-auto transition-transform duration-300" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="mt-2 space-y-2 pl-8">
                        <a href="{{ route('incubation.create') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-plus-circle mr-2"></i>
                            <span class="text-lg">Registrar Incubación</span>
                        </a>
                        <a href="{{ route('incubation.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-list mr-2"></i>
                            <span class="text-lg">Listar Incubaciones</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Incubaciones Activas -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'Usuario')
                <a href="{{ route('incubations_clients.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-vote-yea mr-2"></i>
                    <span class="text-lg">Incubaciones Activas</span>
                </a>
                @endif

                <!-- Catalogo -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'Usuario')
                <a href="{{ route('catalogotipos.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-folder-open mr-2"></i>
                    <span class="text-lg">Catálogo</span>
                </a>
                @endif

                <!-- Historial -->
                @if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'Usuario')
                <a href="{{ url('/historial') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-history mr-2"></i>
                    <span class="text-lg">Historial</span>
                </a>
                @endif

                <!-- Configuración (solo para SuperUsuario) -->
                @if (auth()->user()->rol === 'SuperUsuario')
                <a href="{{ route('configuracion.index') }}" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-tools mr-2"></i>
                    <span class="text-lg">Configuración</span>
                </a>
                @endif

                <!-- Cerrar Sesión -->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-3 text-white rounded-md hover:bg-gray-700 transition duration-300 mt-auto">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span class="text-lg">Cerrar Sesión</span>
                </a>
                <!-- Formulario oculto para enviar la solicitud de cierre de sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </aside>
        @endauth
        <!-- Contenido principal -->
        <main class="flex-1 transition-transform duration-300 ease-in-out" :class="{'md:ml-54': open, 'ml-0': !open}" @class(['p-6' => !Route::is('login')])">
            <!-- Botón para abrir el menú en dispositivos móviles -->
            <button @click="open = !open" class="md:hidden fixed top-4 right-4 inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
                <span class="sr-only">Abrir menú</span>
                <!-- Ícono de menú hamburguesa -->
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            @yield('content')
        </main>
    </div>
    <!-- Sección para incluir scripts adicionales específicos de cada página -->
    @yield('scripts')
</body>
</html>
