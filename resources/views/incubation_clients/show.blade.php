@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold mb-2 text-white">Incubaciones de {{ $client->nombre }}</h1>
                <p class="text-gray-300">
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
        <div class="p-6">
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
                            <!-- Aquí se cargarán dinámicamente las incubaciones -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-8 flex justify-center items-center">
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    <a href="#" id="prev-page" class="pagination-link py-2 px-4 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Anterior</span>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <span id="page-numbers" class="pagination-link py-2 px-4 border-t border-b border-gray-300 bg-white text-gray-700"></span>
                    <a href="#" id="next-page" class="pagination-link py-2 px-4 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Siguiente</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const incubationTableBody = document.querySelector('#incubationTableBody');
    const pageNumbers = document.querySelector('#page-numbers');
    const prevPageLink = document.querySelector('#prev-page');
    const nextPageLink = document.querySelector('#next-page');
    const itemsPerPage = 10;
    let currentPage = 1;
    let incubationData = @json($incubations);

    // Función para mostrar las incubaciones en la página actual
    function displayIncubations() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const incubationsToDisplay = incubationData.slice(startIndex, endIndex);

        incubationTableBody.innerHTML = '';

        incubationsToDisplay.forEach(incubation => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-100');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${incubation.fecha_recepcion}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.producto}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.cantidad}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.tipo_huevo}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.numero_bandeja}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.etapa}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.estado}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.huevos_malos}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.huevos_eclosionados}</td>
                <td class="px-6 py-4 whitespace-nowrap">${incubation.huevos_proceso}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="/actualizaciones/create/${incubation.id}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Actualizar
                        </a>
                        <a href="/actualizaciones?incubacion_id=${incubation.id}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                            Ver Actualizaciones
                        </a>
                    </div>
                </td>
            `;
            incubationTableBody.appendChild(row);
        });
    }

    // Función para actualizar los números de página
    function updatePageNumbers() {
        const totalPages = Math.ceil(incubationData.length / itemsPerPage);
        pageNumbers.textContent = `${currentPage} de ${totalPages}`;

        if (currentPage === 1) {
            prevPageLink.classList.add('opacity-50', 'cursor-not-allowed');
            prevPageLink.removeEventListener('click', goToPreviousPage);
        } else {
            prevPageLink.classList.remove('opacity-50', 'cursor-not-allowed');
            prevPageLink.addEventListener('click', goToPreviousPage);
        }

        if (currentPage === totalPages) {
            nextPageLink.classList.add('opacity-50', 'cursor-not-allowed');
            nextPageLink.removeEventListener('click', goToNextPage);
        } else {
            nextPageLink.classList.remove('opacity-50', 'cursor-not-allowed');
            nextPageLink.addEventListener('click', goToNextPage);
        }
    }

    // Función para ir a la página anterior
    function goToPreviousPage() {
        if (currentPage > 1) {
            currentPage--;
            displayIncubations();
            updatePageNumbers();
        }
    }

    // Función para ir a la página siguiente
    function goToNextPage() {
        const totalPages = Math.ceil(incubationData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayIncubations();
            updatePageNumbers();
        }
    }

    // Función para buscar incubaciones
    function searchIncubations() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();

        incubationData = @json($incubations).filter(incubation => {
            const fechaRecepcion = incubation.fecha_recepcion.toLowerCase();
            const producto = incubation.producto.toLowerCase();
            const cantidad = incubation.cantidad.toString().toLowerCase();
            const tipoHuevo = incubation.tipo_huevo.toLowerCase();
            const numeroBandeja = incubation.numero_bandeja.toLowerCase();
            const etapa = incubation.etapa.toLowerCase();
            const estado = incubation.estado.toLowerCase();
            const huevosNoFertiles = incubation.huevos_malos.toString().toLowerCase();
            const huevosEclosionados = incubation.huevos_eclosionados.toString().toLowerCase();
            const huevosEnProceso = incubation.huevos_proceso.toString().toLowerCase();

            return fechaRecepcion.includes(searchTerm) ||
                producto.includes(searchTerm) ||
                cantidad.includes(searchTerm) ||
                tipoHuevo.includes(searchTerm) ||
                numeroBandeja.includes(searchTerm) ||
                etapa.includes(searchTerm) ||
                estado.includes(searchTerm) ||
                huevosNoFertiles.includes(searchTerm) ||
                huevosEclosionados.includes(searchTerm) ||
                huevosEnProceso.includes(searchTerm);
        });

        currentPage = 1;
        displayIncubations();
        updatePageNumbers();
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchIncubations);

    // Cargar las incubaciones y actualizar los números de página al cargar la página
    displayIncubations();
    updatePageNumbers();
</script>
@endsection
