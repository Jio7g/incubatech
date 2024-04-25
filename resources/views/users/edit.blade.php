@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Editar Usuario</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT') <!-- Este método es necesario para las actualizaciones en Laravel -->

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $user->nombre }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $user->correo }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option value="" disabled>Selecciona un rol</option>
                                <option value="Usuario" {{ $user->rol == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                                <option value="Administrador" {{ $user->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="SuperUsuario" {{ $user->rol == 'SuperUsuario' ? 'selected' : '' }}>SuperUsuario</option>
                            </select>
                        </div>

                        <!-- No es necesario incluir campos de contraseña si no quieres que se actualicen -->

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
