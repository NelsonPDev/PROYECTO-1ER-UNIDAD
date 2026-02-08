<?php
// auth.php
session_start();

// Obtener datos del formulario
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// 1. Validar Administrador
if ($usuario === 'administrador' && $password === 'asd') {
    $_SESSION['usuario'] = 'Admin';
    $_SESSION['rol'] = 'admin';
    // Redirigir al dashboard (este archivo lo hará tu compañero, pero lo dejamos listo)
    header("Location: admin.php"); 
    exit();
} 
// 2. Validar Cliente
elseif ($usuario === 'cliente' && $password === '123') {
    $_SESSION['usuario'] = 'Cliente';
    $_SESSION['rol'] = 'cliente';
    // Redirigir al catálogo (este archivo lo hará tu compañero)
    header("Location: cliente.php"); 
    exit();
} 
// 3. Credenciales Incorrectas
else {
    // Redirigir a la página de error
    header("Location: error.php");
    exit();
}
?>