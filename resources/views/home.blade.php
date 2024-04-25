{{-- Dentro de home.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Widgets de resumen -->
    <div class="dashboard-widget">
        <div class="widget-header">USER</div>
        <div class="widget-body">3</div>
    </div>
    <!-- Repite para cada widget -->

    <!-- Tablas de productos más vendidos, últimas ventas, etc -->
    <div class="dashboard-section">
        <h2>INCUBATECH</h2>
        <table>
            <!-- Contenido de la tabla -->
        </table>
    </div>
    <!-- Repite para cada sección -->
</div>
@endsection

