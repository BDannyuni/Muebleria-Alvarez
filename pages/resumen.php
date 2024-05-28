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

// Consulta para obtener los productos más nuevos
$sql = "SELECT id_producto, nombre_prod, precio_prod, departamento_nom, stock_prod, proveedor_nom, color_nom, material_nom, tapiz_nom 
        FROM productos p INNER JOIN departamentos dep on dep.id_departamento=p.id_departamento INNER JOIN proveedores pro on pro.id_proveedor=p.proveedor INNER JOIN color c on c.id_color=p.id_color INNER JOIN material m on m.id_material=p.id_material INNER JOIN tapiz t on t.id_tapiz=p.id_tapiz
        ORDER BY fecha_creacion DESC 
        LIMIT 6";

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
<<<<<<< HEAD
            Nav header start and sidebar
=======
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="../index.php">
                    <b class="logo-abbr"><img src="../assets/images/logo-blanco.png" alt=""> </b>
                    <span class="logo-compact"><img src="../assets/images/logo-blanco.png" alt=""></span>
                    <span class="brand-title text-white mt-2">
                        <img src="../assets/images/logo-blanco.png" height="32px" style="margin-right:5px;"
                            alt="">Muebleria Alvarez
                    </span>
                </a>
            </div>

        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1">
                                <li><a href="../index.php">Inicio</a></li>
                            </span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1">
                                <li><a href="catalogo.php">Catalogo</a></li>
                            </span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1">
                                <li><a href="nosotros.php">Sobre Nosotros</a></li>
                            </span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1">
                                <li><a href="contacto.php.php">Contacto</a></li>
                            </span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1">
                                <li><a href="resumen.php">Admin</a></li>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">

                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../plantilla/quixlab-master/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i>
                                                <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill badge-primary">3</div>
                                            </a>
                                        </li>

                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="resumen.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Resumen</span>
                        </a>

                    </li>
                    </li>
                    <li class="nav-label">Inventario</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="Listadoproductos.php" aria-expanded="false">
                            <i class="ti-layout"></i><span class="nav-text">Productos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="agregarproductos.php" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Agregar Productos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="departamentos.php" aria-expanded="false">
                            <i class="ti-bag"></i><span class="nav-text">Departamentos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="categorias.php" aria-expanded="false">
                            <i class="ti-layers"></i><span class="nav-text">Categorias</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="pocostock.php" aria-expanded="false">
                            <i class="ti-layers"></i><span class="nav-text">Productos con Poco Stock</span>
                        </a>
                    </li>
                    </li>
                    <li class="nav-label">Venta</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                            <i class="ti-shopping-cart"></i><span class="nav-text">Ventas</span>
                        </a>
                    </li>
                    <li class="nav-label">Extra</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                            <i class="ti-user"></i><span class="nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                            <i class="ti-clipboard"></i><span class="nav-text">Admin Usuarios</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
>>>>>>> 953f086e793a8d028e9eafe50d62b97cfcbfad07
        ***********************************-->
        <?php include('layouts/all.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total de Productos</h3>
                                <div class="d-inline-block">
                                    <h2 id="totalProductos" class="text-white"></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Productos con Poco Stock</h3>
                                <div class="d-inline-block">
                                    <h2 id="totalProductosMinStock" class="text-white"></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                    <h3 class="card-title">Productos Mas Nuevos</h3>
                        <table id="productos-mas-populares" class="table table-xs mb-0">
                            <thead>
                                <tr>
                                    <th>Id Producto</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Proveedor</th>
                                    <th>Color</th>
                                    <th>Material</th>
                                    <th>Tapiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {  
                                    // Salida de datos de cada fila
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id_producto"] . "</td>";
                                        echo "<td>" . $row["nombre_prod"] . "</td>";
                                        echo "<td>" . $row["precio_prod"] . "</td>";
                                        echo "<td>" . $row["departamento_nom"] . "</td>";
                                        echo "<td>" . $row["stock_prod"] . "</td>";
                                        echo "<td>" . $row["proveedor_nom"] . "</td>";
                                        echo "<td>" . $row["color_nom"] . "</td>";
                                        echo "<td>" . $row["material_nom"] . "</td>";
                                        echo "<td>" . $row["tapiz_nom"] . "</td>";
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