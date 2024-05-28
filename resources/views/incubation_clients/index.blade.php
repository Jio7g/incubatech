@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white"><i class="fas fa-vote-yea"></i> Clientes con Datos de Incubación</h1>
            <div class="flex items-center">
                <a href="{{ route('incubation.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                    Agregar Nuevo <i class="fas fa-plus"></i>
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
        <div class="p-6">
            <div class="bg-white shadow-md rounded-lg">
                <ul class="divide-y divide-gray-200" id="clientList">
                    <!-- Aquí se cargarán dinámicamente los clientes -->
                </ul>
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

<!-- Modal de confirmación -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="confirmationModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Compartir proceso de incubación
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="confirmationMessage"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="confirmShare()">
                    Compartir
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeConfirmationModal()">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de enlace generado -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="linkModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Enlace generado
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                El enlace para compartir el proceso de incubación ha sido generado. Puedes copiarlo y enviarlo por otros medios si lo deseas.
                            </p>
                            <div class="mt-4">
                                <input type="text" id="generatedLink" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="copyLink()">
                    Copiar enlace
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeLinkModal()">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let selectedClientId = null;

    function openConfirmationModal(clientId, clientName, clientEmail) {
        selectedClientId = clientId;
        document.getElementById('confirmationMessage').textContent = `¿Desea compartir el proceso de incubación? Se enviará la información a ${clientName} (${clientEmail}).`;
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    function confirmShare() {
        // Realizar la acción de compartir
        fetch(`/incubaciones/compartir/${selectedClientId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('generatedLink').value = data.shareUrl;
                document.getElementById('confirmationModal').classList.add('hidden');
                document.getElementById('linkModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error al compartir:', error);
            });
    }

    function closeLinkModal() {
        document.getElementById('linkModal').classList.add('hidden');
    }

    function copyLink() {
        const linkInput = document.getElementById('generatedLink');
        linkInput.select();
        document.execCommand('copy');
        alert('Enlace copiado al portapapeles');
    }

    const clientList = document.querySelector('#clientList');
    const pageNumbers = document.querySelector('#page-numbers');
    const prevPageLink = document.querySelector('#prev-page');
    const nextPageLink = document.querySelector('#next-page');
    const itemsPerPage = 10;
    let currentPage = 1;
    let clientsData = @json($clientsWithIncubation);

    // Función para mostrar los clientes en la página actual
    function displayClients() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const clientsToDisplay = clientsData.slice(startIndex, endIndex);

        clientList.innerHTML = '';

        clientsToDisplay.forEach(client => {
            const listItem = document.createElement('li');
            listItem.className = 'px-6 py-4';
            listItem.innerHTML = `
                <div class="flex flex-col md:flex-row items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-circle fa-3x text-gray-400"></i>
                    </div>
                    <div class="ml-4 md:ml-6">
                        <div class="text-sm font-medium text-gray-900">${client.nombre}</div>
                        <div class="text-sm text-gray-500">${client.direccion}</div>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <a href="/incubations/${client.id}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-center">
                                <i class="fas fa-eye"></i> Ver Incubaciones
                            </a>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-center" onclick="openConfirmationModal(${client.id}, '${client.nombre}', '${client.correo}')">
                                <i class="fas fa-share-square"></i> Compartir
                            </button>
                        </div>
                    </div>
                </div>
            `;
            clientList.appendChild(listItem);
        });
    }

    // Función para actualizar los números de página
    function updatePageNumbers() {
        const totalPages = Math.ceil(clientsData.length / itemsPerPage);
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
        const totalPages = Math.ceil(clientsData.length / itemsPerPage);
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

        clientsData = @json($clientsWithIncubation).filter(client => {
            const clientName = client.nombre.toLowerCase();
            const clientAddress = client.direccion.toLowerCase();

            return clientName.includes(searchTerm) || clientAddress.includes(searchTerm);
        });

        currentPage = 1;
        displayClients();
        updatePageNumbers();
    }

    // Evento de búsqueda al presionar una tecla
    document.querySelector('#search').addEventListener('keyup', searchClients);

    // Cargar los clientes y actualizar los números de página al cargar la página
    displayClients();
    updatePageNumbers();
</script>
@endsection
