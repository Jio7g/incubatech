@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-4 md:mb-0">Lista de Clientes</h1>
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Añadir Cliente
            </a>
        </div>
        <div class="p-6">
            <div class="relative z-0 mb-6">
                <input type="text" id="search" class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar cliente...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="clientGrid">
                @foreach ($clients as $client)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white py-4 px-6">
                        <h2 class="text-xl font-bold">{{ $client->nombre }}</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 mb-2">Código: {{ $client->codigo }}</p>
                        <p class="text-gray-600 mb-2">Dirección: {{ $client->direccion }}</p>
                        <p class="text-gray-600 mb-2">Teléfono: {{ $client->telefono }}</p>
                        <p class="text-gray-600 mb-4">Correo: {{ $client->correo }}</p>
                        <div class="flex justify-end">
                            <a href="{{ route('clients.edit', $client->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">
                                Editar
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block">
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
</div>
@endsection

@section('scripts')
<script>
    // Función para buscar clientes
    function searchClients() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();
        const clientGrid = document.querySelector('#clientGrid');
        const clientCards = clientGrid.querySelectorAll('div.bg-white');

        clientCards.forEach(card => {
            const name = card.querySelector('h2').textContent.toLowerCase();
            const codigo = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
            const direccion = card.querySelector('p:nth-of-type(2)').textContent.toLowerCase();
            const telefono = card.querySelector('p:nth-of-type(3)').textContent.toLowerCase();
            const correo = card.querySelector('p:nth-of-type(4)').textContent.toLowerCase();

            if (name.includes(searchTerm) || codigo.includes(searchTerm) || direccion.includes(searchTerm) || telefono.includes(searchTerm) || correo.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchClients);
</script>
@endsection
