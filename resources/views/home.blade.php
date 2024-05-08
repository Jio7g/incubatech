<!-- Home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Bienvenido a IncubaTech</h1>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                <div class="text-4xl font-bold text-blue-500">{{ $userCount }}</div>
                <div class="text-lg font-semibold text-gray-600">Usuarios</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                <div class="text-4xl font-bold text-green-500">{{ $clientCount }}</div>
                <div class="text-lg font-semibold text-gray-600">Clientes</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                <div class="text-4xl font-bold text-yellow-500">{{ $ongoingIncubationsCount }}</div>
                <div class="text-lg font-semibold text-gray-600">Incubaciones en Proceso</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                <div class="text-4xl font-bold text-purple-500">{{ $completedIncubationsCount }}</div>
                <div class="text-lg font-semibold text-gray-600">Incubaciones Completadas</div>
            </div>
        </div>

        <!-- Accesos rápidos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300">
                <i class="fas fa-users fa-2x mr-4"></i>
                <span>Gestionar Usuarios</span>
            </a>
            <a href="{{ route('clients.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300">
                <i class="fas fa-address-book fa-2x mr-4"></i>
                <span>Gestionar Clientes</span>
            </a>
            <a href="{{ route('incubation.create') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300">
                <i class="fas fa-plus-circle fa-2x mr-4"></i>
                <span>Registrar Incubación</span>
            </a>
            <a href="{{ route('incubations_clients.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300">
                <i class="fas fa-egg fa-2x mr-4"></i>
                <span>Ver Incubaciones</span>
            </a>
        </div>

        <!-- Gráfico de incubaciones por etapa -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Incubaciones por Etapa</h2>
            <div class="relative h-64">
                <canvas id="incubationChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos de ejemplo para el gráfico de incubaciones por etapa
    const incubationData = {
        labels: ['Etapa 1', 'Etapa 2', 'Etapa 3', 'Etapa 4', 'Etapa 5'],
        datasets: [{
            data: [50, 75, 120, 80, 95],
            backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899'],
        }]
    };

    // Configuración del gráfico
    const incubationChartConfig = {
        type: 'pie',
        data: incubationData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                }
            }
        },
    };

    // Renderizar el gráfico
    const incubationChart = new Chart(
        document.getElementById('incubationChart'),
        incubationChartConfig
    );
</script>
@endsection
