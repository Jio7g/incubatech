@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-3xl font-bold text-white mb-6">Historial de Incubaciones</h1>
        </div>
        <div class="p-6">
            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md mb-6" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">En esta página encontrarás el historial de incubaciones realizadas.</p>
                        <p class="text-sm">Puedes seleccionar un rango específico de fechas para consultar los datos correspondientes.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
                <form action="{{ route('bitacoras.index') }}" method="GET" class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha_inicio">
                            Fecha Inicio
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="date" name="fecha_inicio" value="{{ $fechaInicio }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha_fin">
                            Fecha Fin
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="date" name="fecha_fin" value="{{ $fechaFin }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                            Buscar Cliente
                        </label>
                        <div class="relative">
                            <input type="text" id="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" placeholder="Buscar cliente...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-md rounded">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Cliente</th>
                            <th class="py-3 px-6 text-left">Fecha de Recepción</th>
                            <th class="py-3 px-6 text-left">Detalles</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light" id="clientTableBody">
                        @foreach ($bitacoras as $bitacora)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $bitacora->cliente->nombre }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $bitacora->fecha_recepcion }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <a href="{{ route('bitacoras.show', $bitacora->id) }}" class="text-blue-500 hover:text-blue-700">Ver Detalles</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function searchClients() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#clientTableBody tr');

        rows.forEach(row => {
            const nombre = row.cells[0].textContent.toLowerCase();

            if (nombre.includes(searchTerm)) {
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
