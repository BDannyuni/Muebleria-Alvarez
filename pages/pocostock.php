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

// Consulta para obtener los productos más nuevos con poco stock
$sql = "SELECT p.id_producto, p.nombre_prod, p.precio_prod, ca.categoria_nom, p.stock_prod, pro.proveedor_nom, pro.telefono
        FROM productos p 
        INNER JOIN categorias ca ON ca.id_Categoria = p.categoria_prod 
        INNER JOIN proveedores pro ON pro.id_proveedor = p.proveedor 
        INNER JOIN color c ON c.id_color = p.id_color 
        INNER JOIN material m ON m.id_material = p.id_material 
        INNER JOIN tapiz t ON t.id_tapiz = p.id_tapiz
        WHERE p.stock_prod < 5";

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

    <!-- Importa jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Importa Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Custom CSS for the "agregar" card -->
    <style>
    .edit-btn-stock {
        margin-right: 5px;
        /* Ajusta el espacio entre los botones */
        background-color: #28a745;
        /* Verde */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        /* Añade el cursor de puntero */
    }

    .edit-btn-stock:hover {
        color: #0056b3;
    }
    </style>

    <!-- Agregar jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Agregar Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                                                <th>Categoria</th>
                                                <th>Stock</th>
                                                <th>Proveedor</th>
                                                <th>Telefono</th>
                                                <th>Editar Stock</th>
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
                                            echo "<td>$" . $row["precio_prod"] . "</td>";
                                            echo "<td>" . $row["categoria_nom"] . "</td>";
                                            echo "<td>" . $row["stock_prod"] . "</td>";
                                            echo "<td>" . $row["proveedor_nom"] . "</td>";
                                            echo "<td>" . $row["telefono"] . "</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-primary edit-btn-stock' data-toggle='modal' data-target='#modalEditarStock' data-id='" . $row['id_producto'] . "' data-stock='" . $row['stock_prod'] . "'><i class='fas fa-edit'></i></button>";
                                            echo "</td>";
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
                                                <th>Categoria</th>
                                                <th>Stock</th>
                                                <th>Proveedor</th>
                                                <th>Telefono</th>
                                                <th>Editar Stock</th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>


<!-- Modal para editar el stock -->
<div class="modal fade" id="modalEditarStock" tabindex="-1" role="dialog" aria-labelledby="modalEditarStockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarStockLabel">Editar Stock del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarStock">
                    <div class="form-group">
                        <label for="nuevoStock">Nuevo Stock:</label>
                        <input type="number" class="form-control" id="nuevoStock" name="nuevoStock">
                    </div>
                    <input type="hidden" id="productoId" name="productoId">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        // Una vez que el documento esté cargado, ejecuta esta función
        $(document).ready(function () {
            // Inicializa DataTables en la tabla con id "productos"
            $('#productos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>

<script>
    $(document).ready(function() {
        // Cuando se hace clic en un botón de editar
        $('.edit-btn-stock').click(function() {
            // Obtiene el ID y el stock del producto desde los atributos de datos
            var productoId = $(this).data('id');
            var stockActual = $(this).data('stock');
            
            // Actualiza los campos del formulario en el modal con la información del producto
            $('#productoId').val(productoId);
            $('#nuevoStock').val(stockActual);
        });

        $('#formEditarStock').submit(function(event) {
            // Evita el envío del formulario por defecto
            event.preventDefault();

            // Obtiene los datos del formulario
            var productoId = $('#productoId').val();
            var nuevoStock = $('#nuevoStock').val();

            // Objeto con los datos a enviar al servidor
            var datos = {
                id_producto: productoId,
                nuevo_stock: nuevoStock
            };

            // Realiza la solicitud AJAX
            $.ajax({
                url: 'actualizar_stock.php', // La URL del archivo PHP que manejará la actualización del stock
                type: 'POST', // Método de la solicitud
                data: datos, // Datos a enviar al servidor
                success: function(response) {
                    // Maneja la respuesta del servidor
                    // Aquí podrías mostrar un mensaje de éxito o actualizar la tabla de productos
                    console.log('Stock actualizado exitosamente');
                    // Cierra el modal
                    $('#modalEditarStock').modal('hide');
                    // Recarga la página para actualizar la tabla de productos
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Maneja los errores de la solicitud
                    console.error('Error al actualizar el stock:', error);
                    // Puedes mostrar un mensaje de error aquí si lo deseas
                }
            });
        });
    });
</script>


</body>

</html>