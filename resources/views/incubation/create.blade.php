@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-xl font-bold my-4">Agregar Datos de Incubación</h1>

    <form action="{{ route('incubation.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Botón para abrir el modal -->
        <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700" onclick="openModal()">
            Buscar Cliente
        </button>

        <div class="space-y-2">
            <input type="date" id="fecha_recepcion" name="fecha_recepcion" class="block w-full p-2 border rounded">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="block w-full p-2 border rounded">
            <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="block w-full p-2 border rounded">
            <input type="text" id="telefono" name="telefono" placeholder="Teléfono" class="block w-full p-2 border rounded">
            <input type="text" id="correo" name="correo" placeholder="Correo" class="block w-full p-2 border rounded">
            <input type="hidden" id="cliente_id" name="cliente_id" required>
            <input type="text" class="block w-full p-2 border rounded" id="producto" name="producto" placeholder="Producto" required>
            <input type="number" class="block w-full p-2 border rounded" id="cantidad" name="cantidad" placeholder="Cantidad" required>
            <input type="text" class="block w-full p-2 border rounded" id="tipo_huevo" name="tipo_huevo" placeholder="Tipo de Huevo" required>
            <input type="text" class="block w-full p-2 border rounded" id="numero_bandeja" name="numero_bandeja" placeholder="Número de Bandeja">
            <input type="text" class="block w-full p-2 border rounded" id="etapa" name="etapa" placeholder="Etapa" required>
            <input type="text" class="block w-full p-2 border rounded" id="estado" name="estado" placeholder="Estado" required>
            <textarea class="block w-full p-2 border rounded" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
        </div>

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
                  <tr class="hover:bg-gray-100 cursor-pointer" onclick="selectClient({{ $client->toJson() }})">
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
// Función para abrir el modal y cargar la lista de clientes
function openModal() {
  document.getElementById('clienteModal').classList.remove('hidden');
  fetchClients();  // Llamada a la función que carga los datos de los clientes
}

// Función para cerrar el modal
function closeModal() {
  document.getElementById('clienteModal').classList.add('hidden');
}

// Función para cargar los clientes desde el servidor
function fetchClients() {
  fetch('/api/clients')
    .then(response => response.json())
    .then(clients => {
      const clientListContainer = document.getElementById('client-list');
      clientListContainer.innerHTML = ''; // Limpiar lista anterior
      clients.forEach(client => {
        const clientRow = document.createElement('div');
        clientRow.className = 'p-2 hover:bg-gray-200 cursor-pointer';
        clientRow.textContent = `${client.codigo} - ${client.nombre} - ${client.direccion}`;
        clientRow.onclick = function() {
          selectClient(client);
        };
        clientListContainer.appendChild(clientRow);
      });
    })
    .catch(error => {
      console.error('Error loading the clients:', error);
    });
}

// Función para seleccionar un cliente y llenar los campos del formulario
function selectClient(client) {
  document.getElementById('cliente_id').value = client.id;
  document.getElementById('nombre').value = client.nombre;
  document.getElementById('direccion').value = client.direccion;
  document.getElementById('telefono').value = client.telefono;
  document.getElementById('correo').value = client.correo;
  closeModal();
}


//javascript para filtrar clientes por nombre
document.getElementById('searchClientInput').addEventListener('keyup', function() {
  let input = this.value.toLowerCase();
  let rows = document.querySelectorAll('#clientsTableBody tr');
  rows.forEach(row => {
    let clientName = row.cells[1].textContent.toLowerCase(); // Asume que el nombre del cliente está en la segunda celda
    if (clientName.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
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



</script>
@endsection



