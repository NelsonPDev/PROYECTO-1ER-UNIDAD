<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-commerce</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0,0,0,0.5);
            width: 320px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        h2 { text-align: center; margin-bottom: 30px; }
        .input-group { position: relative; margin-bottom: 20px; }
        input {
            width: 100%;
            padding: 10px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            color: #fff;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            background: #03e9f4;
            border: none;
            padding: 10px;
            color: #050801;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
            text-transform: uppercase;
        }
        button:hover {
            background: #fff;
            box-shadow: 0 0 20px #03e9f4;
        }
    </style>
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
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>