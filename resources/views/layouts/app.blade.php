<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .sidebar {
            background: #f8f9fa; /* Color de fondo */
            height: 100vh; /* Altura completa de la ventana */
            width: 250px; /* Ancho del sidebar */
            position: fixed; /* Fijo en la página */
            left: 0;
            top: 0;
            padding: 20px; /* Espaciado interno */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Sombra sutil */
        }

        .sidebar nav a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s; /* Transición suave */
        }

        .sidebar nav a:hover {
            background-color: #e9ecef;
            color: #0056b3; /* Cambio de color del texto */
        }

        main {
            margin-left: 270px; /* Espacio para el sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
    @auth
        <aside class="sidebar">
            <nav>
                <a href="{{ route('users.index') }}">Usuarios</a>
                <a href="{{ route('clients.index') }}">Clientes</a>
                <a href="{{ url('/registro') }}">Registro</a>
                <a href="{{ url('/incubacion') }}">Incubación</a>
                <a href="{{ url('/historial') }}">Historial</a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </aside>
        @endauth
        <main class="@auth main-content @endauth">
            @yield('content')
        </main>
    </div>
</body>
</html>
