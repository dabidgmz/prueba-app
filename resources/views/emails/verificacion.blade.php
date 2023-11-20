<!DOCTYPE html>
<html>
<head>
    <title>Correo de Verificación</title>
</head>
<body>
    <p>Hola {{ $usuario->nombre }},</p>
    
    <p>Gracias por registrarte. Haz clic en el siguiente enlace para verificar tu cuenta:</p>
    
    <a href="{{ route('verificar.token', $usuario->token) }}">Verificar cuenta</a>
    
    <p>Si no te registraste en nuestro sitio, puedes ignorar este correo.</p>
</body>
</html>
