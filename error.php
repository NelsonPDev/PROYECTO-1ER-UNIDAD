<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de Acceso</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #1a1a1a;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .error-container {
            text-align: center;
            background: rgba(255, 0, 0, 0.1);
            padding: 50px;
            border-radius: 20px;
            border: 2px solid #ff4b2b;
            box-shadow: 0 0 20px rgba(255, 75, 43, 0.5);
        }
        h1 { color: #ff4b2b; font-size: 50px; margin: 0; }
        p { font-size: 18px; margin: 20px 0; }
        a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: #ff4b2b;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }
        a:hover { background: #ff416c; transform: scale(1.1); }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>¡ERROR!</h1>
        <p>Usuario o contraseña incorrectos.</p>
        <a href="index.php">Intentar de nuevo</a>
    </div>
</body>
</html>