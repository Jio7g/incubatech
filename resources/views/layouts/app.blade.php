<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-gray-800">
    <div id="app" class="flex flex-col md:flex-row">
        @auth
        <aside class="bg-gray-100 w-full md:w-64 min-h-screen md:fixed left-0 top-0 p-4 shadow-md">
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
</body>
</html>