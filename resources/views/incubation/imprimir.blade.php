{{-- resources/views/incubation/imprimir.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresion de Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            font-size: 14px;
        }
        .header, .company-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-top: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 16px; /* Ajusta el tamaño de la fuente según necesites */
    }
    td {
        padding: 8px; /* Añade relleno para que el texto no esté justo en el borde */
        text-align: left; /* Asegura que el texto esté alineado a la izquierda */
    }
    tr:nth-child(1) td {
        font-weight: bold; /* Hace que los títulos de los campos sean en negrita */
        border-bottom: 2px solid black; /* Línea más gruesa para la separación */
    }
</style>

</head>
<body>
    <div class="header">
        <h1>Comprobante de Recepcion de Productos</h1>
    </div>

    <div class="company-details">
        <h2>Nombre de la Empresa</h2>
        <p>Dirección: Calle Principal #123, Ciudad, País</p>
        <p>Teléfono: +123 456 7890</p>
        <p>Email: contacto@empresa.com</p>
    </div>

    <div class="datos_registros">
        <p><strong>No. Registro</strong> {{ $incubationData->id }}</p>
        <p><strong>Fecha Recepción:</strong> {{ $incubationData->fecha_recepcion }}</p>
    </div>

    <h2>Datos del Cliente</h2>
@if($incubationData->cliente)
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="border-bottom: 1px solid black;">Nombre Cliente</td>
            <td style="border-bottom: 1px solid black;">Correo</td>
            <td style="border-bottom: 1px solid black;">Direccion Cliente</td>
            <td style="border-bottom: 1px solid black;">Teléfono</td>
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
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="2">Detalles de la Incubación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Cantidad:</strong></td>
                <td>{{ $incubationData->cantidad }}</td>
            </tr>
            <tr>
                <td><strong>Producto:</strong></td>
                <td>{{ $incubationData->producto }}</td>
            </tr>
            <tr>
                <td><strong>Tipo de Huevo:</strong></td>
                <td>{{ $incubationData->tipo_huevo }}</td>
            </tr>
            <tr>
                <td><strong>Descripción:</strong></td>
                <td>{{ $incubationData->descripcion }}</td>
            </tr>
            <!-- más detalles de la incubación según necesites -->
        </tbody>
    </table>
</div>

</body>
</html>
