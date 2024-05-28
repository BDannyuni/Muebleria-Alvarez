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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Agregar jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Agregar DataTables y el archivo de idioma en español -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>

    <!-- Custom CSS for the "agregar" card -->
    <style>
    #agregar {
        background-color: #7571F9;
        /* Fondo de la tarjeta */
        border: 1px solid #ddd;
        /* Borde de la tarjeta */
        border-radius: 8px;
        /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Sombra */
        padding: 15px;
        /* Espacio interno */
    }

    #agregar .card-title {
        font-size: 18px;
        /* Tamaño de la fuente del título */
        font-weight: bold;
        /* Grosor de la fuente del título */
        color: #333;
        /* Color del título */
        margin-bottom: 20px;
        /* Margen inferior */
    }

    #agregar label {
        display: block;
        /* Mostrar etiquetas como bloque */
        margin-bottom: 10px;
        /* Margen inferior */
        font-weight: bold;
        /* Grosor de la fuente de la etiqueta */
        color: #555;
        /* Color de la etiqueta */
    }

    #agregar input[type="number"],
    #agregar input[type="text"] {
        width: 100%;
        /* Ancho completo */
        padding: 10px;
        /* Espacio interno */
        margin-bottom: 15px;
        /* Margen inferior */
        border: 1px solid #ccc;
        /* Borde */
        border-radius: 4px;
        /* Bordes redondeados */
        box-sizing: border-box;
        /* Incluye padding y borde en el ancho total */
    }

    #agregar input[type="submit"] {
        background-color: #4CAF50;
        /* Color de fondo del botón */
        color: white;
        /* Color del texto del botón */
        padding: 10px 20px;
        /* Espacio interno */
        border: none;
        /* Sin borde */
        border-radius: 4px;
        /* Bordes redondeados */
        cursor: pointer;
        /* Cursor de puntero */
    }

    #agregar input[type="submit"]:hover {
        background-color: #45a049;
        /* Color de fondo del botón al pasar el ratón */
    }

    #agregar2 {
        padding: 30px;
        /* Espacio interno */
    }

    .edit-btn {
    margin-right: 5px; /* Ajusta el espacio entre los botones */
    background-color: #28a745; /* Verde */
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer; /* Añade el cursor de puntero */
}

.delete-btn {
    background-color: #dc3545; /* Rojo */
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer; /* Añade el cursor de puntero */
}

.edit-btn:hover, .delete-btn:hover {
    color: #0056b3;
}
    </style>
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

                    <!-- Card para Categorías Más Usadas -->
                    <div class="col-lg-6">
                        <div class="card" id="categoriasUsadas">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos Más Usados</h4>
                                <canvas id="categoriasUsadasChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Card para Categorías Más Vendidas -->
                    <div class="col-lg-6">
                        <div class="card" id="categoriasVendidas">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos Más Vendidos</h4>
                                <canvas id="categoriasVendidasChart"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
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
                                                <th>Departamento</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_Categoria"] . "</td>";
        echo "<td>" . $row["categoria_nom"] . "</td>";
        echo "<td>" . $row["Estado"] . "</td>";
        echo "<td>";
        echo "<button class='edit-btn' data-id='" . $row["id_Categoria"] . "'><i class='fas fa-edit'></i></button>";
        echo "<button class='delete-btn' data-id='" . $row["id_Categoria"] . "'><i class='fas fa-trash'></i></button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>0 resultados</td></tr>";
}
?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Departamento</th>
                                                <th>Estado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-4">
    <div class="card" id="agregar">
        <div class="card-body">
            <div class="card" id="agregar2">
            <div class="text-center"> <!-- Contenedor para centrar el botón -->
                <h4 class="card-tittle">Agregar Nueva Categoría</h4>
                </div><br>
                <form id="agregardepartamento" action="editar_eliminar/agregarcategoria.php" method="post" enctype="multipart/form-data">
                    <label for="id_categoria">ID de la Categoría:</label>
                    <input type="number" name="id_categoria" id="id_categoria" required><br>
                    <label for="nombre_categoria">Nombre de la Categoría:</label>
                    <input type="text" name="nombre_categoria" id="nombre_categoria" required><br>
                    <label for="estado_categoria">Estado de la Categoría:</label>
                    <input type="text" name="estado_categoria" id="estado_categoria" required><br><br>
                    <div class="text-center"> <!-- Contenedor para centrar el botón -->
                    <button type="submit" class="btn mb-1 btn-outline-primary  btn-lg">Agregar Categoría</button>
                    </div>
                    <br><br>
                </form>
            </div>
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
        // Gráfico de Categorías Más Usadas
        fetch('getCategoriasUsadasData.php')
            .then(response => response.json())
            .then(data => {
                const categorias = data.map(item => item.categoria_nom);
                const counts = data.map(item => item.count);

                const ctx = document.getElementById('categoriasUsadasChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Cantidad de Productos',
                            data: counts,
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
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching categories data:', error));

        // Gráfico de Categorías Más Vendidas
        fetch('getCategoriasVendidasData.php')
            .then(response => response.json())
            .then(data => {
                const categorias = data.map(item => item.categoria_nom);
                const totalVendido = data.map(item => item.total_vendido);

                const ctx = document.getElementById('categoriasVendidasChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Total Vendido',
                            data: totalVendido,
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
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching sales data:', error));
    });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Manejar el clic en los botones de editar
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            // Redirigir a una página de edición con el ID de la categoría
            window.location.href = 'editar_eliminar/editarcategoria.php?id=' + id;
        });
    });

    // Manejar el clic en los botones de eliminar
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
                // Realizar una solicitud AJAX para eliminar la categoría
                fetch('editar_eliminar/eliminarcategoria.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        // Recargar la página para ver los cambios
                        window.location.reload();
                    } else {
                        alert('Error al eliminar la categoría.');
                    }
                });
            }
        });
    });
});
    </script>
</body>

</html>