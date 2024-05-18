@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold mb-2">Incubaciones de {{ $client->nombre }}</h1>
            <p class="text-gray-600">
                <strong>Dirección:</strong> {{ $client->direccion }}<br>
                <strong>Teléfono:</strong> {{ $client->telefono }}
            </p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center">
            <a href="{{ route('incubations_clients.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                Volver a Incubaciones
            </a>
            <div class="relative">
                <input type="text" id="search" class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar incubación...">
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
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Fecha de Recepción</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Tipo de Huevo</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">No. Bandeja</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Etapa</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Huevos No Fertiles</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Huevos Eclosionados</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Huevos en Proceso</th>
                        <th class="px-6 py-3 text-center font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="incubationTableBody">
                    @foreach ($incubations as $incubation)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->fecha_recepcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->producto }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->tipo_huevo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->numero_bandeja }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->etapa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->estado }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->huevos_malos }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->huevos_eclosionados }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $incubation->huevos_proceso }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('actualizaciones.create', $incubation->id) }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Actualizar
                        </a>

                        <a href="{{ route('actualizaciones.index', ['incubacion_id' => $incubation->id]) }}"
   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Ver Actualizaciones
</a>


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
    // Función para buscar incubaciones
    function searchIncubations() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#incubationTableBody tr');

        rows.forEach(row => {
            const fechaRecepcion = row.cells[0].textContent.toLowerCase();
            const producto = row.cells[1].textContent.toLowerCase();
            const cantidad = row.cells[2].textContent.toLowerCase();
            const tipoHuevo = row.cells[3].textContent.toLowerCase();
            const numeroBandeja = row.cells[4].textContent.toLowerCase();
            const etapa = row.cells[5].textContent.toLowerCase();
            const estado = row.cells[6].textContent.toLowerCase();
            const descripcion = row.cells[7].textContent.toLowerCase();

            if (fechaRecepcion.includes(searchTerm) || producto.includes(searchTerm) || cantidad.includes(searchTerm) || tipoHuevo.includes(searchTerm) || numeroBandeja.includes(searchTerm) || etapa.includes(searchTerm) || estado.includes(searchTerm) || descripcion.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchIncubations);
</script>
@endsection
