<!-- resources/views/catalogotipos/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Agregar Nuevo Tipo de Catálogo</h1>
    <form method="POST" action="{{ route('catalogotipos.store') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit">Agregar Tipo</button>
    </form>
@endsection
