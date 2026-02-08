<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form action="auth.php" method="POST">
            <div class="input-group">
                <input type="text" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="button-primary">Ingresar</button>
        </form>
    </div>
</body>
</html>