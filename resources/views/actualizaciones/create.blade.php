@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Actualizar Incubación: {{ $incubacion->producto }}</h1>
    
    <!-- Verificar y mostrar errores de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('actualizaciones.store') }}">
        @csrf
        <input type="hidden" name="incubacion_id" value="{{ $incubacion->id }}">
        <input type="hidden" name="cliente_id" value="{{ $incubacion->cliente_id }}">
        <div>
            <label>Huevos Inicio:</label>
            <input type="number" name="huevos_inicio" value="{{ old('huevos_inicio', $incubacion->huevos_proceso) }}">
        </div>
        <div>
            <label>Huevos Malos:</label>
            <input type="number" name="huevos_malos" value="{{ old('huevos_malos') }}">
        </div>
        <div>
            <label>Huevos Eclosionados:</label>
            <input type="number" name="huevos_eclosionados" value="{{ old('huevos_eclosionados') }}">
        </div>
        <div>
            <label>Etapa:</label>
            <input type="text" name="etapa" value="{{ old('etapa') }}">
        </div>
        <div>
            <label>Estado:</label>
            <input type="text" name="estado" value="{{ old('estado') }}">
        </div>
        <div>
            <label>Descripción:</label>
            <textarea name="descripcion">{{ old('descripcion') }}</textarea>
        </div>
        <div>
            <button type="submit">Guardar Actualización</button>
        </div>
    </form>
</div>
@endsection
