<?php
// Establece la conexión con la base de datos
$servername = "localhost"; // Cambia localhost por el nombre del servidor si es necesario
$username = "root";
$password = "";
$dbname = "muebleria";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los registros de la tabla "productos"
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plantilla/quixlab-master/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/plugins/tables/css/datatable/dataTables.bootstrap4.min.css"
        rel="stylesheet">


    <!-- Agregar jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Agregar DataTables y el archivo de idioma en español -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
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
                        <a href="#.php" aria-expanded="false">
                            <i class="ti-bag"></i><span class="nav-text">Departamentos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#.php" aria-expanded="false">
                            <i class="ti-layers"></i><span class="nav-text">Categorias</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#.php" aria-expanded="false">
                            <i class="ti-layers"></i><span class="nav-text">Productos con Poco Stock</span>
                        </a>
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
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos</h4>
                                <div class="table-responsive">
                                    <table id="productos" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Categoria</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    // Itera sobre cada fila del resultado de la consulta y muestra los datos en la tabla
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id_Categoria"] . "</td>";
                                            echo "<td>" . $row["categoria_nom"] . "</td>";
                                            echo "<td>" . $row["Estado"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>0 resultados</td></tr>";
                                    }
                                    ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Categoria</th>
                                                <th>Estado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-tittle">Agregar Categoria Nueva</h4><br><br>
                                <form action="agregarcategoria.php" method="post" enctype="multipart/form-data">
                                    <label for="id_categoria">ID de la Categoria:</label>
                                    <input type="number" name="id_categoria" id="id_categoria" required><br><br>
                                    <label for="nombre_categoria">Nombre de la Categoria:</label>
                                    <input type="text" name="nombre_categoria" id="nombre_categoria" required><br><br>
                                    <label for="estado_categoria">Estado de La Categoria:</label>
                                    <input type="text" name="estado_categoria" id="estado_categoria" required><br><br>

                                </form>
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

    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <!-- ChartistJS -->
    <script src="../plantilla/quixlab-master/plugins/chartist/js/chartist.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js">
    </script>

    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Una vez que el documento esté cargado, ejecuta esta función
    $(document).ready(function() {
        // Inicializa DataTables en la tabla con id "productos"
        $('#productos').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }
        });
    });
    </script>
    <script>
    // Una vez que el documento esté cargado, ejecuta esta función
    $(document).ready(function() {
        // Inicializa DataTables en la tabla con id "productos"
        $('#productos').DataTable();
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
        fetch(
            'getPopularProductsData.php') // Cambia esto al archivo o ruta adecuada que maneje la obtención de datos de productos populares
            .then(response => response.json())
            .then(data => {
                const nombresProductos = data.map(item => item
                .nombre_acortado); // Cambia esta línea para usar el nombre acortado
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

</html>