<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos más populares
$sql = "SELECT p.id_producto, p.nombre_prod, SUM(v.cantidad) as total_vendido
        FROM ventas v
        INNER JOIN productos p ON v.id_producto = p.id_producto
        GROUP BY v.id_producto
        ORDER BY total_vendido DESC
        LIMIT 6";

$result = $conn->query($sql);

// Consulta para obtener las ventas por fechas
$sql = "SELECT
DATE(fecha_venta) AS fecha,
SUM(total_venta) AS total_ventas
FROM
ventas
GROUP BY
DATE(fecha_venta)
ORDER BY
fecha;";

$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Administracion</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo2.png">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">

    <!-- Chartist -->
    <link rel="stylesheet" href="../plantilla/quixlab-master/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet"
        href="../plantilla/quixlab-master/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    
        <!--**********************************
            Header start
        ***********************************-->
        
        <?php include('layouts/all.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                    <h3 class="card-title">Ventas Por Dia</h3>
                        <table id="productos-mas-populares" class="table table-xs mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Total de Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {  
                                    // Salida de datos de cada fila
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["fecha"] . "</td>";
                                        echo "<td>" . $row["total_ventas"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No hay productos disponibles</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total de Ventas</h3>
                                <div class="d-inline-block">
                                    <h2 id="totalVentas" class="text-white"></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total de Ventas de Hoy</h3>
                                <div class="d-inline-block">
                                    <h2 id="totalVentasHoy" class="text-white"></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    
                </div>


<div class="row">
                    <!-- Card de Ventas del Mes -->
                    <div class="col-lg-6">
                        <div class="card" id="graficaventasmes">
                            <div class="card-body">
                                <h4 class="card-title">Ventas del Mes</h4>
                                <canvas id="ventasMesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Card de Ventas del Mes -->
                    <div class="col-lg-6">
                        <div class="card" id="Populares">
                            <div class="card-body">
                                <h4 class="card-title">Productos Populares</h4>
                                <canvas id="productosPopularesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>



                
            </div>



            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                    2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <script src="../plantilla/quixlab-master/js/dashboard/dashboard-1.js"></script>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Chartjs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../plantilla/quixlab-master/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
    <!-- ChartistJS -->
    <script src="../plantilla/quixlab-master/plugins/chartist/js/chartist.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js">
    </script>

    <!-- Chartjs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script>
    $(document).ready(function() {
        // Función para verificar y mostrar alerta si hay productos con poco stock
        function checkLowStock() {
            $.ajax({
                url: "ajax/dashboard.ajax.php",
                method: 'POST',
                dataType: 'json',
                success: function(respuesta) {
                    $("#totalProductos").html(respuesta[0]['totalProductos']);
                    $("#totalVentas").html('$ ' + respuesta[0]['totalVentas']);
                    $("#totalVentasHoy").html('$ ' + respuesta[0]['ventashoy']);
                    $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock']);

                    // Mostrar el modal si hay productos con poco stock
                    if (respuesta[0]['productosPocoStock'] > 0 && !$('#lowStockModal').hasClass(
                            'show')) {
                        $('#lowStockModal').modal('show');
                    }
                }
            });
        }

        // Llamar a la función al cargar la página
        checkLowStock();

        // Intervalo para actualizar los datos y verificar stock cada 10 segundos
        var stockInterval = setInterval(checkLowStock, 600000);

        // Agregar controlador de eventos para el botón "Ir a Reorden"
        $('#goToReorderBtn').on('click', function() {
            $('#lowStockModal').modal('hide');
            clearInterval(stockInterval); // Detener la verificación del stock
        });

        // Controlador de eventos para cerrar el modal al hacer clic en el botón "Cerrar" y el icono "fas fa-times"
        $('.close-modal').on('click', function() {
            $('#lowStockModal').modal('hide');
            clearInterval(stockInterval); // Detener la verificación del stock
        });

        // Controlador de eventos para cerrar el modal cuando se oculta
        $('#lowStockModal').on('hidden.bs.modal', function() {
            clearInterval(stockInterval); // Detener la verificación del stock
        });

        // Controlador de eventos para abrir el modal cuando se muestra
        $('#lowStockModal').on('shown.bs.modal', function() {
            stockInterval = setInterval(checkLowStock,
            600000); // Iniciar la verificación del stock nuevamente
        });

    });
    </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('getSalesData.php')
        .then(response => response.json())
        .then(data => {
            const fechas = data.map(item => item.fecha);
            const totales = data.map(item => item.total);

            const ctx = document.getElementById('ventasMesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Cambia el tipo de gráfico a 'line'
                data: {
                    labels: fechas,
                    datasets: [{
                        label: 'Ventas del Mes',
                        data: totales,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo para el área bajo la línea
                        borderColor: 'rgba(54, 162, 235, 1)', // Color de la línea
                        borderWidth: 1,
                        fill: true // Esto es lo que crea el área bajo la línea
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.4 // Agrega suavidad a las líneas, crea un efecto de onda
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching sales data:', error));
});

document.addEventListener("DOMContentLoaded", function() {
    fetch('getPopularProductsData.php') // Cambia esto al archivo o ruta adecuada que maneje la obtención de datos de productos populares
        .then(response => response.json())
        .then(data => {
            const nombresProductos = data.map(item => item.nombre_acortado); // Cambia esta línea para usar el nombre acortado
            const totalesVendidos = data.map(item => item.total_vendido);

            const ctx = document.getElementById('productosPopularesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Cambia el tipo de gráfico a 'polarArea'
                data: {
                    labels: nombresProductos,
                    datasets: [{
                        label: 'Productos Populares',
                        data: totalesVendidos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ], // Colores de fondo para cada segmento del gráfico de polarArea
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ], // Colores del borde para cada segmento del gráfico de polarArea
                        borderWidth: 1
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            top: 40, // Ajusta el espacio superior para que el gráfico no se vea demasiado grande verticalmente
                            bottom: 40
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom' // Coloca la leyenda en la parte inferior del gráfico
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching popular products data:', error));
});
</script>


</body>