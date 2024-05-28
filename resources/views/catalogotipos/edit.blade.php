<!-- resources/views/catalogotipos/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Editar Tipo de Catálogo</h1>
    <form method="POST" action="{{ route('catalogotipos.update', $catalogoTipo->id) }}">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $catalogoTipo->nombre) }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
