@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Configuración</h1>
    <form action="{{ route('configuracion.update', $configuracion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Método necesario para actualizar -->
        <div class="form-group">
            <label for="nit_empresa">NIT Empresa</label>
            <input type="text" class="form-control" id="nit_empresa" name="nit_empresa" value="{{ $configuracion->nit_empresa }}" required>
        </div>
        <div class="form-group">
            <label for="nombre_empresa">Nombre Empresa</label>
            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="{{ $configuracion->nombre_empresa }}" required>
        </div>
        <div class="form-group">
            <label for="direccion_empresa">Dirección Empresa</label>
            <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" value="{{ $configuracion->direccion_empresa }}" required>
        </div>
        <div class="form-group">
            <label for="telefono_empresa">Teléfono Empresa</label>
            <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" value="{{ $configuracion->telefono_empresa }}" required>
        </div>
        <div class="form-group">
            <label for="correo_empresa">Correo Empresa</label>
            <input type="email" class="form-control" id="correo_empresa" name="correo_empresa" value="{{ $configuracion->correo_empresa }}" required>
        </div>
        <div class="form-group">
            <label for="logo_empresa">Logo Empresa (actual)</label>
            <input type="file" class="form-control" id="logo_empresa" name="logo_empresa">
            @if($configuracion->logo_empresa)
                <img src="{{ Storage::url($configuracion->logo_empresa) }}" alt="Logo actual" style="width: 100px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
