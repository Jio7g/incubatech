{{-- resources/views/clients/edit.blade.php --}}
@extends('layouts.app')



@section('content')
<div class="container">
    <h1>Editar Cliente</h1>
    <form method="POST" action="{{ route('clients.update', $client->id) }}">
    @csrf
    @method('PUT')


        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $client->nombre }}" required>
        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input type="direccion" class="form-control" id="direccion" name="direccion" value="{{ $client->direccion }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="telefono" class="form-control" id="telefono" name="telefono" value="{{ $client->telefono }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $client->correo }}" required>
                        </div>

                        <!-- No es necesario incluir campos de contraseña si no quieres que se actualicen -->

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Actualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
