@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Datos de Incubación</h1>
    @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <form method="POST" action="{{ route('incubation.update', $incubationData->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fecha_recepcion" class="form-label">Fecha Recepcion</label>
            <input type="date" class="form-control" id="fecha_recepcion" name="fecha_recepcion" value="{{ $incubationData->fecha_recepcion }}" required>
        </div>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Id Cliente</label>
            <input type="number" class="form-control" id="cliente_id" name="cliente_id" value="{{ $incubationData->cliente_id }}" required>
        </div>


        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="form-control" id="producto" name="producto" value="{{ $incubationData->producto }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $incubationData->cantidad }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_huevo" class="form-label">Tipo de Huevo</label>
            <input type="text" class="form-control" id="tipo_huevo" name="tipo_huevo" value="{{ $incubationData->tipo_huevo }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_bandeja" class="form-label">No. Bandeja</label>
            <input type="number" class="form-control" id="numero_bandeja" name="numero_bandeja" value="{{ $incubationData->numero_bandeja }}" required>
        </div>

        <div class="mb-3">
            <label for="etapa" class="form-label">Etapa</label>
            <input type="text" class="form-control" id="etapa" name="etapa" value="{{ $incubationData->etapa }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $incubationData->estado }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $incubationData->descripcion }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
