@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold mb-4 md:mb-0">Lista de Clientes</h1>
        <div class="flex items-center">
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                Añadir Cliente
            </a>
            <div class="relative">
                <input type="text" id="search" class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar cliente...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider cursor-pointer" onclick="sortTable(0)">
                            ID
                            <svg class="h-4 w-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Dirección</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Correo</th>
                        <th class="px-6 py-3 text-center font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="clientTableBody">
                    @foreach ($clients as $client)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->codigo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->direccion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->telefono }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->correo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="mr-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 font-medium">
                                        Eliminar
                                    </button>
                                </form>
                                <a href="{{ route('clients.edit', $client->id) }}" class="text-blue-500 hover:text-blue-600 font-medium">
                                    Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Función para ordenar la tabla por ID
    function sortTable(columnIndex) {
        const table = document.querySelector('table');
        const tbody = table.querySelector('#clientTableBody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        const sortedRows = rows.sort((a, b) => {
            const aValue = a.cells[columnIndex].textContent.trim();
            const bValue = b.cells[columnIndex].textContent.trim();

            if (columnIndex === 0) {
                // Si es la columna de ID, convertir los valores a números antes de comparar
                return Number(aValue) - Number(bValue);
            } else {
                // Para las demás columnas, usar la comparación de cadenas
                return aValue.localeCompare(bValue, undefined, { numeric: true });
            }
        });

        tbody.innerHTML = '';
        sortedRows.forEach(row => tbody.appendChild(row));
    }

    // Función para buscar clientes
    function searchClients() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#clientTableBody tr');

        rows.forEach(row => {
            const codigo = row.cells[1].textContent.toLowerCase();
            const nombre = row.cells[2].textContent.toLowerCase();
            const direccion = row.cells[3].textContent.toLowerCase();
            const telefono = row.cells[4].textContent.toLowerCase();
            const correo = row.cells[5].textContent.toLowerCase();

            if (codigo.includes(searchTerm) || nombre.includes(searchTerm) || direccion.includes(searchTerm) || telefono.includes(searchTerm) || correo.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchClients);
</script>
@endsection
