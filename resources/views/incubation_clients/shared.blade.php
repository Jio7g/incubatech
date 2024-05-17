@auth
@extends('layouts.app')
@endauth

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center mb-4">
        <img src="{{ asset('storage/logos/avitec/LogoAvitec.png') }}" alt="Logo de Avitec" class="h-20">
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white px-6 py-4">
            <h1 class="text-3xl font-bold mb-2 text-center">Información de incubación de {{ $client->nombre }}</h1>
        </div>

        <div class="p-6">
            <!-- Sección de filtro y ordenamiento -->
            <div class="mb-8 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 relative">
                    <label for="date-filter" class="block text-gray-700 font-bold mb-2">Filtrar por fecha:</label>
                    <div class="flex items-center">
                        <input type="date" id="date-filter" class="w-full px-4 py-2 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button id="clear-filter" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-r-lg hover:bg-gray-300 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="sort-select" class="block text-gray-700 font-bold mb-2">Ordenar por:</label>
                    <select id="sort-select" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="newest">Más recientes primero</option>
                        <option value="oldest">Más antiguas primero</option>
                    </select>
                </div>
            </div>

            <!-- Sección de lista de incubaciones -->
            <div id="incubations-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($incubations as $incubation)
                <div class="bg-gray-100 rounded-lg p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $incubation->producto }}</h2>
                    <div class="mb-2">
                        <span class="font-semibold">Fecha de Recepción:</span>
                        <span class="ml-2">{{ $incubation->fecha_recepcion }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Cantidad:</span>
                        <span class="ml-2">{{ $incubation->cantidad }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Tipo de Huevo:</span>
                        <span class="ml-2">{{ $incubation->tipo_huevo }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">No. Bandeja:</span>
                        <span class="ml-2">{{ $incubation->numero_bandeja }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Etapa:</span>
                        <span class="ml-2 badge badge-{{ $incubation->etapa_color }}">{{ $incubation->etapa }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Estado:</span>
                        <span class="ml-2 badge badge-{{ $incubation->estado_color }}">{{ $incubation->estado }}</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Descripción:</h3>
                        <p class="text-gray-700">{{ $incubation->descripcion }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginación -->
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

    <!-- Sección de información de contacto de Avitec -->
    <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Información de contacto de Avitec</h2>
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="mb-4 md:mb-0 md:mr-8">
                    <p class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>
                        Calzada Héctor Augusto España Bracamonte, Chiquimula, Chiquimula, Guatemala C.A.
                    </p>
                    <p class="flex items-center mb-2">
                        <i class="fas fa-phone mr-2 text-indigo-600"></i>
                        +502 7942 2287
                    </p>
                    <p class="flex items-center mb-2">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>
                        info@avitecgt.com
                    </p>
                    <p class="flex items-center">
                        <i class="fab fa-facebook mr-2 text-indigo-600"></i>
                        <a href="https://www.facebook.com/Avitecta/" target="_blank" class="text-indigo-600 hover:text-indigo-800">Facebook</a>
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d61717.27059019696!2d-89.537833!3d14.806759000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6231a643751621%3A0xb0a4fad77091b181!2sAvitec!5e0!3m2!1ses-419!2sus!4v1715958531828!5m2!1ses-419!2sus" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener elementos del DOM
        const dateFilter = document.getElementById('date-filter');
        const clearFilterBtn = document.getElementById('clear-filter');
        const sortSelect = document.getElementById('sort-select');
        const prevPageLink = document.getElementById('prev-page');
        const nextPageLink = document.getElementById('next-page');
        const pageNumbers = document.getElementById('page-numbers');
        const incubationsContainer = document.getElementById('incubations-container');
        const incubationsPerPage = 6;
        let currentPage = 1;

        // Función para filtrar las incubaciones por fecha
        function filterByDate() {
            const selectedDate = dateFilter.value;
            const incubations = Array.from(incubationsContainer.children);

            incubations.forEach(incubation => {
                const incubationDate = incubation.querySelector('.ml-2').textContent;

                if (selectedDate && incubationDate !== selectedDate) {
                    incubation.style.display = 'none';
                } else {
                    incubation.style.display = 'block';
                }
            });

            currentPage = 1;
            showIncubations();
            updatePaginationLinks();
        }

        // Función para limpiar el filtro de fecha
        function clearFilter() {
            dateFilter.value = '';
            filterByDate();
        }

        // Función para ordenar las incubaciones
        function sortIncubations() {
            const selectedOrder = sortSelect.value;
            const incubations = Array.from(incubationsContainer.children);

            incubations.sort((a, b) => {
                const dateA = new Date(a.querySelector('.ml-2').textContent);
                const dateB = new Date(b.querySelector('.ml-2').textContent);

                if (selectedOrder === 'newest') {
                    return dateB - dateA;
                } else {
                    return dateA - dateB;
                }
            });

            incubations.forEach(incubation => {
                incubationsContainer.appendChild(incubation);
            });

            currentPage = 1;
            showIncubations();
            updatePaginationLinks();
        }

        // Función para mostrar las incubaciones de la página actual
        function showIncubations() {
            const startIndex = (currentPage - 1) * incubationsPerPage;
            const endIndex = startIndex + incubationsPerPage;
            const incubations = Array.from(incubationsContainer.children);

            incubations.forEach((incubation, index) => {
                if (index >= startIndex && index < endIndex) {
                    incubation.style.display = 'block';
                } else {
                    incubation.style.display = 'none';
                }
            });
        }

        // Función para actualizar los enlaces de paginación
        function updatePaginationLinks() {
            const totalIncubations = incubationsContainer.children.length;
            const totalPages = Math.ceil(totalIncubations / incubationsPerPage);

            // Actualizar botones "Anterior" y "Siguiente"
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

            // Actualizar números de página
            pageNumbers.textContent = `Página ${currentPage} de ${totalPages}`;
        }

        // Función para ir a la página anterior
        function goToPreviousPage(event) {
            event.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                showIncubations();
                updatePaginationLinks();
            }
        }

        // Función para ir a la página siguiente
        function goToNextPage(event) {
            event.preventDefault();
            const totalIncubations = incubationsContainer.children.length;
            const totalPages = Math.ceil(totalIncubations / incubationsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                showIncubations();
                updatePaginationLinks();
            }
        }

        // Event listeners para filtrado, ordenamiento y paginación
        dateFilter.addEventListener('change', filterByDate);
        clearFilterBtn.addEventListener('click', clearFilter);
        sortSelect.addEventListener('change', sortIncubations);

        // Mostrar las incubaciones iniciales y actualizar los enlaces de paginación
        showIncubations();
        updatePaginationLinks();
    });
</script>
