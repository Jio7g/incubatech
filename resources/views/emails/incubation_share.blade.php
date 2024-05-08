<!DOCTYPE html>
<html>
<head>
    <title>Información de incubación compartida</title>
</head>
<body>
    <h1>Hola {{ $client->nombre }},</h1>
    <p>Aquí tienes el enlace para acceder a la información de incubación:</p>
    <p><a href="{{ $shareUrl }}">{{ $shareUrl }}</a></p>
    <p>Gracias,</p>
    <p>El equipo de IncubaTech System</p>
</body>
</html>
