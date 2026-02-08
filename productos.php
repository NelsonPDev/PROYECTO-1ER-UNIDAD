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
    ['id' => 1, 'nombre' => 'Laptop Gamer Pro', 'precio' => 25000, 'stock' => 15, 'imagen' => 'img/laptop.png'],
    ['id' => 2, 'nombre' => 'Teclado Mecánico RGB', 'precio' => 1800, 'stock' => 50, 'imagen' => 'img/teclado.png'],
    ['id' => 3, 'nombre' => 'Mouse Inalámbrico', 'precio' => 950, 'stock' => 70, 'imagen' => 'img/mouse.png'],
    ['id' => 4, 'nombre' => 'Monitor Curvo 27"', 'precio' => 7200, 'stock' => 25, 'imagen' => 'img/monitor.png'],
    ['id' => 5, 'nombre' => 'Audífonos con Micrófono', 'precio' => 1200, 'stock' => 40, 'imagen' => 'img/audifonos.png'],
    ['id' => 6, 'nombre' => 'Webcam Full HD', 'precio' => 1500, 'stock' => 30, 'imagen' => 'img/webcam.png']
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
            <a href="productos.php?logout=true" class="logout-btn">Cerrar Sesión</a>
        </div>
    </header>

    <main class="container">
        <form action="total.php" method="post" id="cart-form">
            <input type="hidden" name="cart_data" id="cart-data">

            <div class="cart-actions">
                <button type="submit" class="button-primary">Ver Total a Pagar</button>
            </div>
            
            <div class="product-grid">
                <?php foreach ($productos as $producto): ?>
                    <div class="product-card" id="card-<?php echo $producto['id']; ?>">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-image">
                        <div class="product-info">
                            <h2 class="product-title"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                            <p class="product-price">$<?php echo number_format($producto['precio'], 2); ?></p>
                            <p class="product-stock">Disponibles: <?php echo $producto['stock']; ?></p>
                            <div class="product-controls">
                                <label>Cantidad:</label>
                                <input type="number" 
                                       class="quantity-input"
                                       value="1" 
                                       min="1" 
                                       max="<?php echo $producto['stock']; ?>">
                                <button type="button" class="button-add" data-id="<?php echo $producto['id']; ?>">Agregar</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = {};
            const cartDataInput = document.getElementById('cart-data');
            const addButtons = document.querySelectorAll('.button-add');

            addButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const productId = e.target.dataset.id;
                    const productCard = document.getElementById(`card-${productId}`);
                    const quantityInput = productCard.querySelector('.quantity-input');
                    const quantity = parseInt(quantityInput.value, 10);

                    if (quantity > 0) {
                        // Add or update quantity in the cart object
                        cart[productId] = (cart[productId] || 0) + quantity;
                        
                        // Update the hidden input
                        cartDataInput.value = JSON.stringify(cart);

                        // Visual feedback
                        e.target.textContent = 'Agregado ✔';
                        e.target.classList.add('added');
                        
                        // Reset after a moment
                        setTimeout(() => {
                            e.target.textContent = 'Agregar';
                            e.target.classList.remove('added');
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>
</html>
