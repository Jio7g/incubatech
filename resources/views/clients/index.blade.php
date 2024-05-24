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
            <div id="clientGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Aquí se cargarán dinámicamente los clientes -->
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
                            Eliminar Cliente
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de que quieres eliminar este cliente? Esta acción no se puede deshacer.
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
    const clientGrid = document.querySelector('#clientGrid');
    const pageNumbers = document.querySelector('#page-numbers');
    const prevPageLink = document.querySelector('#prev-page');
    const nextPageLink = document.querySelector('#next-page');
    const clientsPerPage = 8;
    let currentPage = 1;
    let clients = @json($clients);

    // Función para mostrar los clientes en la página actual
    function displayClients() {
        const startIndex = (currentPage - 1) * clientsPerPage;
        const endIndex = startIndex + clientsPerPage;
        const clientsToDisplay = clients.slice(startIndex, endIndex);

        clientGrid.innerHTML = '';

        clientsToDisplay.forEach(client => {
            const clientCard = `
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white py-4 px-6">
                        <h2 class="text-xl font-bold">${client.nombre}</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 mb-2">Código: ${client.codigo}</p>
                        <p class="text-gray-600 mb-2">Dirección: ${client.direccion}</p>
                        <p class="text-gray-600 mb-2">Teléfono: ${client.telefono}</p>
                        <p class="text-gray-600 mb-4">Correo: ${client.correo}</p>
                        <div class="flex justify-end">
                            <a href="/clients/${client.id}/edit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">
                                Editar
                            </a>
                            <button type="button" class="delete-client-btn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" data-client-id="${client.id}">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            `;

            clientGrid.innerHTML += clientCard;
        });
    }

    // Función para actualizar los números de página
    function updatePageNumbers() {
        const totalPages = Math.ceil(clients.length / clientsPerPage);
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
            displayClients();
            updatePageNumbers();
        }
    }

    // Función para ir a la página siguiente
    function goToNextPage() {
        const totalPages = Math.ceil(clients.length / clientsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayClients();
            updatePageNumbers();
        }
    }

    // Función para buscar clientes
    function searchClients() {
        const searchInput = document.querySelector('#search');
        const searchTerm = searchInput.value.toLowerCase();

        clients = @json($clients).filter(client => {
            const name = client.nombre.toLowerCase();
            const codigo = client.codigo.toLowerCase();
            const direccion = client.direccion.toLowerCase();
            const telefono = client.telefono.toLowerCase();
            const correo = client.correo.toLowerCase();

            return name.includes(searchTerm) || codigo.includes(searchTerm) || direccion.includes(searchTerm) || telefono.includes(searchTerm) || correo.includes(searchTerm);
        });

        currentPage = 1;
        displayClients();
        updatePageNumbers();
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchClients);

    // Funcionalidad del modal de confirmación de eliminación
    const deleteModal = document.querySelector('#deleteModal');
    const deleteForm = document.querySelector('#deleteForm');
    const confirmDeleteButton = document.querySelector('#confirmDelete');
    const cancelDeleteButton = document.querySelector('#cancelDelete');
    let clientIdToDelete = null;

    // Abrir el modal al hacer clic en el botón "Eliminar"
    clientGrid.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-client-btn')) {
            clientIdToDelete = e.target.dataset.clientId;
            deleteForm.action = `{{ route('clients.destroy', ':id') }}`.replace(':id', clientIdToDelete);
            deleteModal.classList.remove('hidden');
        }
    });

    // Cerrar el modal al hacer clic en el botón "Cancelar"
    cancelDeleteButton.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        clientIdToDelete = null;
    });

    // Cargar los clientes y actualizar los números de página al cargar la página
    displayClients();
    updatePageNumbers();
</script>
@endsection
