<?php
// cliente.php - Catálogo de Productos
session_start();

// Si se solicita cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Verificar que el usuario sea un cliente autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'cliente') {
    // Si no es cliente, redirigir al login
    header("Location: index.php");
    exit();
}

// Catálogo de productos (sin base de datos)
$productos = [
    ['id' => 1, 'nombre' => 'Laptop Gamer Pro', 'precio' => 25000, 'stock' => 15, 'imagen' => 'https://placehold.co/300x300/2c5364/ffffff?text=Laptop'],
    ['id' => 2, 'nombre' => 'Teclado Mecánico RGB', 'precio' => 1800, 'stock' => 50, 'imagen' => 'https://placehold.co/300x300/203a43/ffffff?text=Teclado'],
    ['id' => 3, 'nombre' => 'Mouse Inalámbrico', 'precio' => 950, 'stock' => 70, 'imagen' => 'https://placehold.co/300x300/0f2027/ffffff?text=Mouse'],
    ['id' => 4, 'nombre' => 'Monitor Curvo 27"', 'precio' => 7200, 'stock' => 25, 'imagen' => 'https://placehold.co/300x300/2c5364/ffffff?text=Monitor'],
    ['id' => 5, 'nombre' => 'Audífonos con Micrófono', 'precio' => 1200, 'stock' => 40, 'imagen' => 'https://placehold.co/300x300/203a43/ffffff?text=Audifonos'],
    ['id' => 6, 'nombre' => 'Webcam Full HD', 'precio' => 1500, 'stock' => 30, 'imagen' => 'https://placehold.co/300x300/0f2027/ffffff?text=Webcam']
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header">
        <h1>Catálogo de Productos</h1>
        <div class="user-info">
            <span class="username">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="cliente.php?logout=true" class="logout-btn">Cerrar Sesión</a>
        </div>
    </header>

    <main class="container">
        <form action="total.php" method="post" class="product-grid">
            <?php foreach ($productos as $producto): ?>
                <div class="product-card">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-image">
                    <div class="product-info">
                        <h2 class="product-title"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                        <p class="product-price">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <p class="product-stock">Disponibles: <?php echo $producto['stock']; ?></p>
                        <div class="product-quantity">
                            <label for="producto_<?php echo $producto['id']; ?>">Cantidad:</label>
                            <input type="number" 
                                   name="cantidades[<?php echo $producto['id']; ?>]" 
                                   id="producto_<?php echo $producto['id']; ?>" 
                                   value="0" 
                                   min="0" 
                                   max="<?php echo $producto['stock']; ?>"
                                   class="quantity-input">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="cart-actions">
                <button type="submit" class="button-primary">Ver Total a Pagar</button>
            </div>
        </form>
    </main>

</body>
</html>
