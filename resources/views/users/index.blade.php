@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 transition-all duration-300 ease-in-out" :class="{'ml-64': open}">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-center px-6 py-4 bg-gray-100">
            <h1 class="text-3xl font-bold mb-4 md:mb-0">Lista de Usuarios</h1>
            <div class="flex items-center">
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                    NUEVO USUARIO
                </a>
                <div class="relative z-0">
                    <input type="text" id="search" class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar usuario...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-6" id="userGrid">
            @foreach ($users as $user)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white py-4 px-6">
                    <h2 class="text-xl font-bold">{{ $user->nombre }}</h2>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-2">{{ $user->correo }}</p>
                    <p class="text-gray-600 mb-4">{{ $user->rol }}</p>
                    <div class="flex justify-end">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">
                            Editar
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Función para buscar usuarios
    function searchUsers() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();
        const userGrid = document.querySelector('#userGrid');
        const userCards = userGrid.querySelectorAll('div.bg-white');

        userCards.forEach(card => {
            const name = card.querySelector('h2').textContent.toLowerCase();
            const email = card.querySelector('p:first-of-type').textContent.toLowerCase();
            const role = card.querySelector('p:last-of-type').textContent.toLowerCase();

            if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchUsers);
</script>
@endsection
