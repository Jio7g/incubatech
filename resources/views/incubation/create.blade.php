@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-xl font-bold my-4">Agregar Datos de Incubación</h1>

    <form id="incubationForm" action="{{ route('incubation.store') }}" method="POST" class="space-y-4">
        @csrf

<div class="grid grid-cols-3 gap-4">

        <input type="hidden" id="cliente_id" name="cliente_id">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_recepcion">
                Fecha Recepción:
            </label>
            <input type="date" id="fecha_recepcion" name="fecha_recepcion" class="block w-full p-2 border rounded">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_estimada">
                Fecha Estimmada de Entrega:
            </label>
            <input type="date" id="fecha_estimada" name="fecha_estimada" class="block w-full p-2 border rounded">
            @error('fecha_estimada')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Datos del Cliente
            </label>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre Cliente" class="block w-full p-2 border rounded">
                </div>
                <div>
                    <input type="text" id="telefono" name="telefono" placeholder="Teléfono" class="block w-full p-2 border rounded">
                </div>
                <div class="col-span-2">
                    <input type="text" id="direccion" name="direccion" placeholder="Dirección Cliente" class="block w-full p-2 border rounded">
                </div>
                <div class="col-span-2">
                    <input type="text" id="correo" name="correo" placeholder="Correo" class="block w-full p-2 border rounded">
                </div>
                <div class="col-span-1">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" onclick="openModal()">
                        Buscar Cliente
                    </button>
                </div>
                <div class="col-span-1">
                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full" onclick="clearClientFields()">
                    Borrar Campos
                </button>

                </div>
            </div>
        </div>
    </div>


        <div class="space-y-2">
        <label class="block text-gray-700 text-sm font-bold mb-2">
                Detalle de la Recepción
            </label>
            <input type="text" class="block w-full p-2 border rounded" id="producto" name="producto" placeholder="Producto" value="{{ old('producto') }}" required>
            <input type="number" class="block w-full p-2 border rounded" id="cantidad" name="cantidad" placeholder="Cantidad" value="{{ old('cantidad') }}" required>
            <input type="text" class="block w-full p-2 border rounded" id="tipo_huevo" name="tipo_huevo" placeholder="Tipo de Huevo" value="{{ old('tipo_huevo') }}" required>
            <input type="text" class="block w-full p-2 border rounded" id="numero_bandeja" name="numero_bandeja" placeholder="Número de Bandeja" value="{{ old('numero_bandeja') }}">
            <select class="block w-full p-2 border rounded" id="etapa" name="etapa" value="{{ old('etapa') }}" required>
              <option value="Recepción">Recepción</option>
            </select>

            <select class="block w-full p-2 border rounded" id="estado" name="estado" value="{{ old('estado') }}" required>
              <option value="recepcion">Recepcion</option>
            </select>

            <textarea class="block w-full p-2 border rounded" id="descripcion" name="descripcion" placeholder="Descripción" value="{{ old('descripcion') }}" required></textarea>


        <button type="submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Guardar</button>
    </form>
</div>

<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="clienteModal" aria-labelledby="clienteModalLabel" aria-modal="true" role="dialog">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- Modal content -->
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Código
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Dirección
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Acción
                    </th>
                  </tr>
                </thead>
                <tbody id="clientsTableBody" class="bg-white divide-y divide-gray-200">
                  @foreach($clients as $client)
                  <tr class="hover:bg-gray-100 cursor-pointer" data-client='@json($client)' onclick="selectClientFromData(this)">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ $client->codigo }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ $client->nombre }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ $client->direccion }}
                    </td>
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
function openModal() {
  document.getElementById('clienteModal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('clienteModal').classList.add('hidden');
}

function selectClientFromData(element) {
  const clientData = element.getAttribute('data-client');
  const client = JSON.parse(clientData);

  // Asegúrate de que los IDs aquí coincidan con los de tus inputs en el HTML
  document.getElementById('cliente_id').value = client.id;
  document.getElementById('nombre').value = client.nombre;
  document.getElementById('direccion').value = client.direccion;
  document.getElementById('telefono').value = client.telefono;
  document.getElementById('correo').value = client.correo;

  closeModal();
}

// Añade la función para filtrar clientes en la búsqueda
document.getElementById('searchClientInput').addEventListener('keyup', function() {
  const input = this.value.toLowerCase();
  const rows = document.querySelectorAll('#clientsTableBody tr');
  rows.forEach(row => {
    const clientName = row.cells[1].textContent.toLowerCase();
    row.style.display = clientName.includes(input) ? "" : "none";
  });
});

//script para colocar default la fecha corriente a la fecha de creacion
document.addEventListener("DOMContentLoaded", function() {
    var fechaCreacionInput = document.getElementById('fecha_recepcion');
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    fechaCreacionInput.value = today;
});

function clearClientFields() {
    // Obtén todos los elementos input, select y textarea dentro del formulario
    const inputs = document.querySelectorAll('#incubationForm input, #incubationForm select, #incubationForm textarea');

    // Itera sobre cada elemento y restablece su valor
    inputs.forEach(input => {
        switch (input.type) {
            case 'checkbox':
            case 'radio':
                // Restablece checkboxes y radios a su estado no marcado por defecto
                input.checked = false;
                break;
            case 'date':
                // Opcional: Restablece las fechas a una fecha específica o déjalas en blanco
                input.value = '';  // Vacío, o puedes usar una fecha por defecto
                break;
            default:
                // Restablece el valor de todos los demás tipos de input y de textarea
                input.value = '';
                break;
        }
    });
}



</script>
@endsection



