<?php
/**
 * Panel Administrador - Gráficas de Ventas Simuladas
 * Datos ficticios para demostración sin base de datos
 */

// Datos simulados de ventas mensuales
$ventasMensuales = array(
    'Enero' => 4500,
    'Febrero' => 5200,
    'Marzo' => 4800,
    'Abril' => 6100,
    'Mayo' => 5900,
    'Junio' => 7200,
    'Julio' => 6800,
    'Agosto' => 7500,
    'Septiembre' => 6200,
    'Octubre' => 8100,
    'Noviembre' => 9300,
    'Diciembre' => 10200
);

// Calcular estadísticas
$totalVentas = array_sum($ventasMensuales);
$promedioMensual = $totalVentas / count($ventasMensuales);
$ventaMaxima = max($ventasMensuales);
$mesMaximoKey = array_search($ventaMaxima, $ventasMensuales);
$ventaMinima = min($ventasMensuales);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador - Gráficas de Ventas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Chart.js para las gráficas -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body>
    <div class="admin-container">
        <!-- Contenido Principal -->
        <main class="admin-content">
            <header class="admin-header">
                <h1>Panel de Administración - Gráficas de Ventas</h1>
                <p>Datos simulados para demostración</p>
            </header>

            <!-- Estadísticas Principales -->
            <section class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">💰</div>
                    <div class="stat-info">
                        <h3>Total de Ventas</h3>
                        <p class="stat-value">$<?php echo number_format($totalVentas, 2, '.', ','); ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📈</div>
                    <div class="stat-info">
                        <h3>Promedio Mensual</h3>
                        <p class="stat-value">$<?php echo number_format($promedioMensual, 2, '.', ','); ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⬆️</div>
                    <div class="stat-info">
                        <h3>Venta Máxima</h3>
                        <p class="stat-value">$<?php echo number_format($ventaMaxima, 2, '.', ','); ?></p>
                    </div>
                </div>
            </section>

            <!-- Gráficas -->
            <section class="charts-container">
                <!-- Gráfica de Ventas Mensuales -->
                <div class="chart-wrapper">
                    <h2>Ventas Mensuales</h2>
                    <canvas id="ventasMensualesChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <!-- Scripts para las gráficas -->
    <script>
        // Configuración de colores
        const colores = {
            principal: '#3498db',
            secundario: '#e74c3c',
            terciario: '#2ecc71',
            cuaternario: '#f39c12'
        };

        // 1. Gráfica de Ventas Mensuales
        const ventasMensualesCtx = document.getElementById('ventasMensualesChart').getContext('2d');
        const ventasMensualesData = <?php echo json_encode([
            'labels' => array_keys($ventasMensuales),
            'values' => array_values($ventasMensuales)
        ]); ?>;

        new Chart(ventasMensualesCtx, {
            type: 'line',
            data: {
                labels: ventasMensualesData.labels,
                datasets: [{
                    label: 'Ventas Mensuales ($)',
                    data: ventasMensualesData.values,
                    borderColor: colores.principal,
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: colores.principal,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        labels: { font: { size: 14 } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString('es-MX');
                            }
                        }
                    }
                }
            }
        });

    </script>
</body>
</html>
