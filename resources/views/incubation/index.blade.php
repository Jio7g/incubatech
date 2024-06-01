@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white"><i class="fas fa-list"></i> Listado de Datos de Incubación</h1>
            <div class="flex items-center">
                <a href="{{ route('incubation.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                    Agregar Nueva incubación <i class="fas fa-plus"></i>
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
            <div class="mb-6">
                <form action="{{ route('incubation.index') }}" method="GET" class="flex items-center">
                    <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fechaInicio }}" class="border border-gray-300 rounded mr-2">
                    <input type="date" name="fecha_fin" id="fecha_fin" value="{{ $fechaFin }}" class="border border-gray-300 rounded mr-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Buscar <i class="fas fa-search"></i></button>
                </form>
            </div>

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('error') }}
            </div>
            @endif

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
                                <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Fecha Recepción</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Código Cliente</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Nombre Cliente</th>
                                <th class="px-6 py-3 text-center font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="incubationTableBody">
                            <!-- Aquí se cargarán dinámicamente los datos de incubación -->
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

<!-- Modal de confirmación de eliminación -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Eliminar Registro de Incubación
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de que quieres eliminar este registro de incubación? Esta acción no se puede deshacer.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" action="" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="confirmDelete" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Eliminar
                    </button>
                </form>
                <button type="button" id="cancelDelete" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
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
    let incubationData = @json($data);

    // Función para mostrar los datos de incubación en la página actual
    function displayIncubationData() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const incubationDataToDisplay = incubationData.slice(startIndex, endIndex);

        incubationTableBody.innerHTML = '';

        incubationDataToDisplay.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${item.id}</td>
                <td class="px-6 py-4 whitespace-nowrap">${item.fecha_recepcion}</td>
                <td class="px-6 py-4 whitespace-nowrap">${item.cliente.codigo}</td>
                <td class="px-6 py-4 whitespace-nowrap">${item.cliente.nombre}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center space-x-4">
                        <a href="/incubation/${item.id}" class="text-blue-500 hover:text-blue-600 font-medium">
                            Ver Detalles
                        </a>
                        <a href="/incubation/${item.id}/edit" class="text-yellow-500 hover:text-yellow-600 font-medium">
                            Editar
                        </a>
                        <button type="button" class="delete-incubation-btn text-red-500 hover:text-red-600 font-medium" data-incubation-id="${item.id}">
                            Eliminar
                        </button>
                        <a href="/incubation/${item.id}/imprimir" target="_blank" class="text-green-500 hover:text-green-600 font-medium">
                            Imprimir
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
            displayIncubationData();
            updatePageNumbers();
        }
    }

    // Función para ir a la página siguiente
    function goToNextPage() {
        const totalPages = Math.ceil(incubationData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayIncubationData();
            updatePageNumbers();
        }
    }

    // Función para ordenar la tabla por ID
    function sortTable(columnIndex) {
        incubationData.sort((a, b) => {
            const aValue = a.id;
            const bValue = b.id;
            return aValue - bValue;
        });

        currentPage = 1;
        displayIncubationData();
        updatePageNumbers();
    }

    // Función para buscar datos de incubación
    function searchIncubation() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();

        incubationData = @json($data).filter(item => {
            const id = item.id.toString().toLowerCase();
            const fechaRecepcion = item.fecha_recepcion.toLowerCase();
            const clienteId = item.cliente.codigo.toLowerCase();
            const clienteCodigo = item.cliente.codigo.toLowerCase();
            const clienteNombre = item.cliente.nombre.toLowerCase();

            return id.includes(searchTerm) || fechaRecepcion.includes(searchTerm) || clienteId.includes(searchTerm) || clienteCodigo.includes(searchTerm) || clienteNombre.includes(searchTerm);
        });

        currentPage = 1;
        displayIncubationData();
        updatePageNumbers();
    }

    function filtrarPorFechas() {
        const fechaInicio = document.getElementById('fecha_inicio').value;
        const fechaFin = document.getElementById('fecha_fin').value;
        incubationData = @json($data).filter(item => {
        const fechaRecepcion = item.fecha_recepcion;
        return fechaRecepcion >= fechaInicio && fechaRecepcion <= fechaFin;
    });

    currentPage = 1;
    displayIncubationData();
    updatePageNumbers();
}

// Evento de búsqueda al presionar una tecla
document.querySelector('#search').addEventListener('keyup', searchIncubation);

// Evento de filtro por fechas al enviar el formulario
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario
    filtrarPorFechas();
});

// Funcionalidad del modal de confirmación de eliminación
const deleteModal = document.querySelector('#deleteModal');
const deleteForm = document.querySelector('#deleteForm');
const confirmDeleteButton = document.querySelector('#confirmDelete');
const cancelDeleteButton = document.querySelector('#cancelDelete');
let incubationIdToDelete = null;

// Abrir el modal al hacer clic en el botón "Eliminar"
incubationTableBody.addEventListener('click', (e) => {
    if (e.target.classList.contains('delete-incubation-btn')) {
        incubationIdToDelete = e.target.dataset.incubationId;
        deleteForm.action = `{{ route('incubation.destroy', ':id') }}`.replace(':id', incubationIdToDelete);
        deleteModal.classList.remove('hidden');
    }
});

// Cerrar el modal al hacer clic en el botón "Cancelar"
cancelDeleteButton.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
    incubationIdToDelete = null;
});

// Cargar los datos de incubación y actualizar los números de página al cargar la página
displayIncubationData();
updatePageNumbers();
</script>
@endsection
