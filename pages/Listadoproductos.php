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
$sql = "SELECT * FROM productos";
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
    <link href="../plantilla/quixlab-master/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

    
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

    <?php include('layouts/all.php'); ?>
    
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inventario</h4>
                        <div class="table-responsive">
                            <table id="productos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>id Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Departamento</th>
                                        <th>Stock</th>
                                        <th>Proveedor</th>
                                        <th>Color</th>
                                        <th>Material</th>
                                        <th>Tapiz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Itera sobre cada fila del resultado de la consulta y muestra los datos en la tabla
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id_producto"] . "</td>";
                                            echo "<td>" . $row["nombre_prod"] . "</td>";
                                            echo "<td>" . $row["precio_prod"] . "</td>";
                                            echo "<td>" . $row["id_departamento"] . "</td>";
                                            echo "<td>" . $row["stock_prod"] . "</td>";
                                            echo "<td>" . $row["proveedor"] . "</td>";
                                            // Aquí necesitas manejar la obtención de color, material y tapiz
                                            echo "<td>" . $row["id_color"] . "</td>";
                                            echo "<td>" . $row["id_material"] . "</td>";
                                            echo "<td>" . $row["id_tapiz"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>0 resultados</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>id Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Departamento</th>
                                        <th>Stock</th>
                                        <th>Proveedor</th>
                                        <th>Color</th>
                                        <th>Material</th>
                                        <th>Tapiz</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                <p>Copyright &copy; Todos Los Derechos Reservados | Esta Pagina esta Hecha solo para fin educativo <br> Hecho por <a href="https://colorlib.com" target="_blank">Brandon</a> y <a href="https://colorlib.com" target="_blank">Maximo</a></p>
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

</body>

</html>