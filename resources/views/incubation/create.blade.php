@extends('layouts.app')

@section('content')
<!-- Contenedor principal -->
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Encabezado con degradado -->
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white"><i class="fas fa-egg"></i> Agregar Datos de Incubación</h1>
        </div>
        <div class="p-6">
            <form id="incubationForm" action="{{ route('incubation.store') }}" method="POST">
                @csrf

                <!-- Sección de fechas y datos del cliente -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fecha_recepcion" class="block text-gray-700 font-bold mb-2">Fecha Recepción:</label>
                        <input type="date" id="fecha_recepcion" name="fecha_recepcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fecha_recepcion') }}" required>
                    </div>

                    <div>
                        <label for="fecha_estimada" class="block text-gray-700 font-bold mb-2">Fecha Estimada de Entrega:</label>
                        <input type="date" id="fecha_estimada" name="fecha_estimada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fecha_estimada') }}" required>
                        @error('fecha_estimada')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-gray-700 font-bold mb-2">Datos del Cliente</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <input type="hidden" id="cliente_id" name="cliente_id">
                        <div>
                            <input type="text" id="nombre" name="nombre" placeholder="Nombre Cliente" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nombre') }}">
                        </div>
                        <div>
                            <input type="text" id="telefono" name="telefono" placeholder="Teléfono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('telefono') }}">
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="direccion" name="direccion" placeholder="Dirección Cliente" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('direccion') }}">
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="correo" name="correo" placeholder="Correo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('correo') }}">
                        </div>
                        <div class="md:col-span-2 flex justify-between">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="openModal()">Buscar Cliente <i class="fas fa-search"></i></button>
                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="clearClientFields()">Borrar Campos <i class="fas fa-eraser"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Sección de detalles de la recepción -->
                <div class="mt-6">
                    <label class="block text-gray-700 font-bold mb-2">Detalle de la Recepción</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="producto" name="producto" placeholder="Producto" value="{{ old('producto') }}" required>
                        </div>
                        <div>
                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cantidad" name="cantidad" placeholder="Cantidad" value="{{ old('cantidad') }}" required>
                        </div>
                        <div>
                        <label for="tipo_huevo" class="block text-gray-700 font-bold mb-2">Tipo de Huevo:</label>
                        <select id="tipo_huevo" name="tipo_huevo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="" disabled selected>Seleccione un tipo de huevo</option>
                        @foreach ($catalogoTipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                        </select>
                        </div>



                        <div>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="numero_bandeja" name="numero_bandeja" placeholder="Número de Bandeja" value="{{ old('numero_bandeja') }}">
                        </div>
                        <div>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="etapa" name="etapa" value="{{ old('etapa') }}" required>
                                <option value="Recepción">Recepción</option>
                            </select>
                        </div>
                        <div>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="estado" name="estado" value="{{ old('estado') }}" required>
                                <option value="recepcion">Recepcion</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descripcion" name="descripcion" placeholder="Descripción" required>{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Botón de guardar -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><i class="fas fa-save"></i> Guardar Datos de Incubación </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para buscar clientes -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="clienteModal" aria-labelledby="clienteModalLabel" aria-modal="true" role="dialog">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="clienteModalLabel">Seleccionar Cliente</h3>
                        <input type="text" id="searchClientInput" placeholder="Buscar por nombre..." class="mt-2 mb-4 block w-full px-4 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="mt-2">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="clientsTableBody" class="bg-white divide-y divide-gray-200">
                                    @foreach($clients as $client)
                                    <tr class="hover:bg-gray-100 cursor-pointer" data-client='@json($client)' onclick="selectClientFromData(this)">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->codigo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->direccion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Seleccionar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal
    function openModal() {
        document.getElementById('clienteModal').classList.remove('hidden');
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('clienteModal').classList.add('hidden');
    }

    // Función para seleccionar un cliente de la tabla
    function selectClientFromData(element) {
        const clientData = element.getAttribute('data-client');
        const client = JSON.parse(clientData);

        // Asignar los valores del cliente a los campos correspondientes
        document.getElementById('cliente_id').value = client.id;
        document.getElementById('nombre').value = client.nombre;
        document.getElementById('direccion').value = client.direccion;
        document.getElementById('telefono').value = client.telefono;
        document.getElementById('correo').value = client.correo;

        closeModal();
    }

    // Función para filtrar clientes en la búsqueda
    document.getElementById('searchClientInput').addEventListener('keyup', function() {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll('#clientsTableBody tr');
        rows.forEach(row => {
            const clientName = row.cells[1].textContent.toLowerCase();
            row.style.display = clientName.includes(input) ? "" : "none";
        });
    });

    // Función para establecer la fecha actual en el campo "fecha_recepcion"
    document.addEventListener("DOMContentLoaded", function() {
        var fechaCreacionInput = document.getElementById('fecha_recepcion');
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        fechaCreacionInput.value = today;
    });

    // Función para borrar los campos del formulario
    function clearClientFields() {
        // Obtener todos los elementos input, select y textarea dentro del formulario
        const inputs = document.querySelectorAll('#incubationForm input, #incubationForm select, #incubationForm textarea');

        // Iterar sobre cada elemento y restablecer su valor
        inputs.forEach(input => {
            switch (input.type) {
                case 'checkbox':
                case 'radio':
                    // Restablecer checkboxes y radios a su estado no marcado por defecto
                    input.checked = false;
                    break;
                case 'date':
                    // Restablecer las fechas a una fecha específica o dejarlas en blanco
                    input.value = ''; // Vacío, o puedes usar una fecha por defecto
                    break;
                default:
                    // Restablecer el valor de todos los demás tipos de input y de textarea
                    input.value = '';
                    break;
            }
        });
    }
</script>
@endsection
