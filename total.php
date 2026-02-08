<?php
// total.php - Resumen y Total de la Compra
session_start();

// Verificar que el usuario sea un cliente autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: index.php");
    exit();
}

// Catálogo de productos (debe ser idéntico al de productos.php para consistencia)
$productos = [
    ['id' => 1, 'nombre' => 'Laptop Gamer Pro', 'precio' => 25000, 'stock' => 15, 'imagen' => 'img/laptop.png'],
    ['id' => 2, 'nombre' => 'Teclado Mecánico RGB', 'precio' => 1800, 'stock' => 50, 'imagen' => 'img/teclado.png'],
    ['id' => 3, 'nombre' => 'Mouse Inalámbrico', 'precio' => 950, 'stock' => 70, 'imagen' => 'img/mouse.png'],
    ['id' => 4, 'nombre' => 'Monitor Curvo 27"', 'precio' => 7200, 'stock' => 25, 'imagen' => 'img/monitor.png'],
    ['id' => 5, 'nombre' => 'Audífonos con Micrófono', 'precio' => 1200, 'stock' => 40, 'imagen' => 'img/audifonos.png'],
    ['id' => 6, 'nombre' => 'Webcam Full HD', 'precio' => 1500, 'stock' => 30, 'imagen' => 'img/webcam.png']
];

// Obtener el JSON del carrito desde el campo oculto
$cart_json = isset($_POST['cart_data']) ? $_POST['cart_data'] : '{}';
$cart = json_decode($cart_json, true);

$resumen_compra = [];
$total_pagar = 0;

if (!empty($cart)) {
    // Crear un mapa de productos por ID para fácil acceso
    $productos_map = [];
    foreach ($productos as $p) {
        $productos_map[$p['id']] = $p;
    }

    foreach ($cart as $id => $cantidad) {
        // Asegurarse de que el ID del producto es numérico
        $id = (int)$id;
        $cantidad = (int)$cantidad;

        // Verificar que el producto exista y la cantidad sea válida
        if (isset($productos_map[$id]) && $cantidad > 0) {
            $producto = $productos_map[$id];

            // Asegurarse de no exceder el stock
            if ($cantidad > $producto['stock']) {
                $cantidad = $producto['stock'];
            }
            
            $subtotal = $cantidad * $producto['precio'];
            $total_pagar += $subtotal;
            
            $resumen_compra[] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad,
                'subtotal' => $subtotal
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total a Pagar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header">
        <h1>Resumen de tu Compra</h1>
        <div class="user-info">
            <span class="username">Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="productos.php?logout=true" class="logout-btn">Cerrar Sesión</a>
        </div>
    </header>

    <main class="container">
        <div class="total-summary">
            <?php if (empty($resumen_compra)): ?>
                <div class="empty-cart">
                    <h2>No has seleccionado ningún producto.</h2>
                    <a href="productos.php" class="button-secondary">Volver al Catálogo</a>
                </div>
            <?php else: ?>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resumen_compra as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                                <td><?php echo $item['cantidad']; ?></td>
                                <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="total-label">Total a Pagar:</td>
                            <td class="total-amount">$<?php echo number_format($total_pagar, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="cart-actions">
                    <a href="productos.php" class="button-secondary">Modificar Pedido</a>
                    <a href="#" class="button-primary" onclick="alert('¡Gracias por tu compra! (Funcionalidad de pago no implementada)');">Confirmar y Pagar</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
