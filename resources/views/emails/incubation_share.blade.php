<!DOCTYPE html>
<html>
<head>
    <title>Información de incubación compartida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #2196F3;
            padding: 30px;
            text-align: center;
        }

        .header img {
            max-width: 200px;
        }

        .content {
            padding: 30px;
        }

        h1 {
            color: #333333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            color: #666666;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #FF9800;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #F57C00;
        }

        .footer {
            background-color: #f7f7f7;
            padding: 20px;
            text-align: center;
            font-size: 16px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="Logo1.png" alt="Logo de AviTec"> --}}
        </div>
        <div class="content">
            <h1>Hola {{ $client->nombre }},</h1>
            <p>¡Gracias por utilizar IncubaTech System! Aquí tienes el enlace para acceder a la información de tu incubación:</p>
            <p><a href="{{ $shareUrl }}" class="button">Ver información de incubación</a></p>
            <p>Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en contactarnos. Estamos aquí para ayudarte en todo momento.</p>
        </div>
        <div class="footer">
            Atentamente,<br>
            El equipo de IncubaTech System
        </div>
    </div>
</body>
</html>
