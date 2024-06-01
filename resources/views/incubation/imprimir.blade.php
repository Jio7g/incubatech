<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresión de Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            font-size: 14px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .company-details {
            text-align: center;
            margin-right: 1000px;
        }

        .details {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-print {
            display: none;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            @if ($configuracion->logo_empresa)
                <img src="{{ asset('storage/' . $configuracion->logo_empresa) }}" alt="Logo de la Empresa">
            @else
                <p>No hay logo disponible.</p>
            @endif
        </div>
        <div class="company-details">
            <h2>{{ $configuracion->nombre_empresa }}</h2>
            <p>{{ $configuracion->direccion_empresa }}</p>
            <p>{{ $configuracion->telefono_empresa }}</p>
            <p>{{ $configuracion->correo_empresa }}</p>
        </div>
    </div>

    <h1 class="text-center">Comprobante de Recepción de Productos</h1>

    <div class="datos_registros">
        <p><strong>No. Registro:</strong> {{ $incubationData->id }}</p>
        <p><strong>Fecha Recepción:</strong> {{ $incubationData->fecha_recepcion }}</p>
        <p><strong>Fecha Estimada de Entrega:</strong> {{ $incubationData->fecha_estimada }}</p>
    </div>

    <h2>Datos del Cliente</h2>
    @if($incubationData->cliente)
        <table>
            <tr>
                <th>Nombre Cliente</th>
                <th>Correo</th>
                <th>Dirección Cliente</th>
                <th>Teléfono</th>
            </tr>
            <tr>
                <td>{{ $incubationData->cliente->nombre }}</td>
                <td>{{ $incubationData->cliente->correo }}</td>
                <td>{{ $incubationData->cliente->direccion }}</td>
                <td>{{ $incubationData->cliente->telefono }}</td>
            </tr>
        </table>
    @else
        <p>No hay datos del cliente disponibles.</p>
    @endif

    <div class="details">
        <h2>Detalles de la Incubación</h2>
        <table>
            <tr>
                <th>Cantidad</th>
                <td>{{ $incubationData->cantidad }}</td>
            </tr>
            <tr>
                <th>Producto</th>
                <td>{{ $incubationData->producto }}</td>
            </tr>
            <tr>
                <th>Tipo de Huevo</th>
                <td>{{ $incubationData->tipo_huevo }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $incubationData->descripcion }}</td>
            </tr>
            <!-- más detalles de la incubación según necesites -->
        </table>
    </div>

    <div class="no-print">
        <button onclick="window.print()">Imprimir</button>
    </div>
</body>
</html>
