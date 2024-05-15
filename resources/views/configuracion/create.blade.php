@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($configuracion) ? 'Editar' : 'Crear' }} Configuración</h1>
    <form action="{{ isset($configuracion) ? route('configuracion.update', $configuracion) : route('configuracion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($configuracion))
            @method('PUT')
        @endif
        <div class="form-group">
            <label>NIT Empresa</label>
            <input type="text" name="nit_empresa" value="{{ $configuracion->nit_empresa ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Nombre Empresa</label>
            <input type="text" name="nombre_empresa" value="{{ $configuracion->nombre_empresa ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Dirección Empresa</label>
            <input type="text" name="direccion_empresa" value="{{ $configuracion->direccion_empresa ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono Empresa</label>
            <input type="text" name="telefono_empresa" value="{{ $configuracion->telefono_empresa ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Correo Empresa</label>
            <input type="email" name="correo_empresa" value="{{ $configuracion->correo_empresa ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Logo Empresa</label>
            <input type="file" name="logo_empresa" class="form-control">
            @if(isset($configuracion) && $configuracion->logo_empresa)
                <div>
                    <img src="{{ Storage::url($configuracion->logo_empresa) }}" alt="Logo" style="width: 150px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($configuracion) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>
@endsection
