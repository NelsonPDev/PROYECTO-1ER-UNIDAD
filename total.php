<?php
// total.php - Resumen y Total de la Compra
session_start();

// Verificar que el usuario sea un cliente autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: index.php");
    exit();
}

// Catálogo de productos (debe ser idéntico al de cliente.php para consistencia)
$productos = [
    ['id' => 1, 'nombre' => 'Laptop Gamer Pro', 'precio' => 25000, 'stock' => 15, 'imagen' => 'https://placehold.co/300x300/2c5364/ffffff?text=Laptop'],
    ['id' => 2, 'nombre' => 'Teclado Mecánico RGB', 'precio' => 1800, 'stock' => 50, 'imagen' => 'https://placehold.co/300x300/203a43/ffffff?text=Teclado'],
    ['id' => 3, 'nombre' => 'Mouse Inalámbrico', 'precio' => 950, 'stock' => 70, 'imagen' => 'https://placehold.co/300x300/0f2027/ffffff?text=Mouse'],
    ['id' => 4, 'nombre' => 'Monitor Curvo 27"', 'precio' => 7200, 'stock' => 25, 'imagen' => 'https://placehold.co/300x300/2c5364/ffffff?text=Monitor'],
    ['id' => 5, 'nombre' => 'Audífonos con Micrófono', 'precio' => 1200, 'stock' => 40, 'imagen' => 'https://placehold.co/300x300/203a43/ffffff?text=Audifonos'],
    ['id' => 6, 'nombre' => 'Webcam Full HD', 'precio' => 1500, 'stock' => 30, 'imagen' => 'https://placehold.co/300x300/0f2027/ffffff?text=Webcam']
];

// Obtener las cantidades del formulario POST
$cantidades = isset($_POST['cantidades']) ? $_POST['cantidades'] : [];

$resumen_compra = [];
$total_pagar = 0;

foreach ($productos as $producto) {
    $id = $producto['id'];
    // Verificar si se seleccionó una cantidad para este producto y es mayor a cero
    if (isset($cantidades[$id]) && $cantidades[$id] > 0) {
        $cantidad_seleccionada = (int)$cantidades[$id];
        
        // Asegurarse de no exceder el stock
        if ($cantidad_seleccionada > $producto['stock']) {
            $cantidad_seleccionada = $producto['stock'];
        }
        
        $subtotal = $cantidad_seleccionada * $producto['precio'];
        $total_pagar += $subtotal;
        
        $resumen_compra[] = [
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad' => $cantidad_seleccionada,
            'subtotal' => $subtotal
        ];
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
            <a href="cliente.php?logout=true" class="logout-btn">Cerrar Sesión</a>
        </div>
    </header>

    <main class="container">
        <div class="total-summary">
            <?php if (empty($resumen_compra)): ?>
                <div class="empty-cart">
                    <h2>No has seleccionado ningún producto.</h2>
                    <a href="cliente.php" class="button-secondary">Volver al Catálogo</a>
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
                    <a href="cliente.php" class="button-secondary">Modificar Pedido</a>
                    <a href="#" class="button-primary" onclick="alert('¡Gracias por tu compra! (Funcionalidad de pago no implementada)');">Confirmar y Pagar</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
