<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
</head>
<body>
    <h1>Contrato de Trabajo</h1>
    <p>Yo, <strong>{{ $user->name }}</strong>, identificado con el correo <strong>{{ $user->email }}</strong>, 
    acepto el cargo de <strong>{{ $user->role }}</strong> en Syscom Colombia desde el <strong>{{ $user->start_date }}</strong>.</p>
    
    <p>Firma: ___________________________</p>
</body>
</html>
