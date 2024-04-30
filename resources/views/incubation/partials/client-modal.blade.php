<!-- Modal -->
<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clienteModalLabel">Modal Clientes</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $client)
            <tr>
              <td>{{ $client->id }}</td>
              <td>{{ $client->nombre }}</td>
              <td>{{ $client->direccion }}</td>
              <td>
                <button class="btn btn-primary select-client" data-id="{{ $client->id }}" data-nombre="{{ $client->nombre }}" data-direccion="{{ $client->direccion }}" data-telefono="{{ $client->telefono }}" data-correo="{{ $client->correo }}">
                  Seleccionar
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
