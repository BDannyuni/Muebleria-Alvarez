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

// Consulta SQL para obtener todos los registros de la tabla "color"
$sqlColor = "SELECT * FROM color";
$resultColor = $conn->query($sqlColor);

// Consulta SQL para obtener todos los registros de la tabla "material"
$sqlMaterial = "SELECT * FROM material";
$resultMaterial = $conn->query($sqlMaterial);

// Consulta SQL para obtener todos los registros de la tabla "tapiz"
$sqlTapiz = "SELECT * FROM tapiz";
$resultTapiz = $conn->query($sqlTapiz);
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

    <!-- Page plugins css -->
    <link href="../plantilla/quixlab-master/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="../plantilla/quixlab-master/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../plantilla/quixlab-master/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="../plantilla/quixlab-master/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plantilla/quixlab-master/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


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

    .delete-btn {
        background-color: #dc3545;
        /* Rojo */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        /* Añade el cursor de puntero */
    }

    .edit-btn:hover,
    .delete-btn:hover {
        color: #0056b3;
    }
    


    .edit-btn-material {
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

    .delete-btn-material {
        background-color: #dc3545;
        /* Rojo */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        /* Añade el cursor de puntero */
    }

    .edit-btn-material:hover,
    .delete-btn-material:hover {
        color: #0056b3;
    }

    .edit-btn-color {
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

    .delete-btn-color {
        background-color: #dc3545;
        /* Rojo */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        /* Añade el cursor de puntero */
    }

    .edit-btn-colorl:hover,
    .delete-btn-color:hover {
        color: #0056b3;
    }

    .edit-btn-tapiz {
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

    .delete-btn-tapiz {
        background-color: #dc3545;
        /* Rojo */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        /* Añade el cursor de puntero */
    }

    .edit-btn-tapiz:hover,
    .delete-btn-tapiz:hover {
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

        <?php include('layouts/all.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid">

                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Materiales <button class="btn btn-primary btn-sm ml-2"
                                        id="btnAgregarMaterial" data-toggle="modal"
                                        data-target="#modalAgregarMaterial">Agregar</button></h4>
                                <div class="table-responsive">
                                    <table id="tablaMaterial" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($resultMaterial->num_rows > 0) {
    while ($row = $resultMaterial->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_material"] . "</td>";
        echo "<td>" . $row["material_nom"] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-primary edit-btn-material' data-toggle='modal' data-target='#modalEditarMaterial' data-id='" . $row['id_material'] . "'><i class='fas fa-edit'></i></button>";
        echo "<button class='delete-btn-material' data-id='" . $row["id_material"] . "'><i class='fas fa-trash'></i></button>";
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
                                                <th>Nombre</th>
                                                <th>Acciones</th>
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
                                <h4 class="card-title">Colores <button class="btn btn-primary btn-sm ml-2"
                                        id="btnAgregarColor" data-toggle="modal"
                                        data-target="#modalAgregarColor">Agregar</button></h4>
                                <div class="table-responsive">
                                    <table id="tablaColor" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Color</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
if ($resultColor->num_rows > 0) {
    while ($row = $resultColor->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_color"] . "</td>";
        echo "<td>" . $row["color_nom"] . "</td>";
        echo "<td style='background-color: " . $row["colorHex"] . "'></td>"; // Celda con color de fondo
        echo "<td>";
        echo "<button class='btn btn-primary edit-btn-color' data-toggle='modal' data-target='#modalEditarColor'  data-id='" . $row['id_color'] . "' data-color='" . $row['colorHex'] . "'><i class='fas fa-edit'></i></button>";
        echo "<button class='delete-btn-color' data-id='" . $row["id_color"] . "'><i class='fas fa-trash'></i></button>";
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
                                                <th>Nombre</th>
                                                <th>Color</th>
                                                <th>Acciones</th>
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
                                <h4 class="card-title">Tapices <button class="btn btn-primary btn-sm ml-2"
                                        id="btnAgregarTapiz" data-toggle="modal"
                                        data-target="#modalAgregarTapiz">Agregar</button></h4>
                                <div class="table-responsive">
                                    <table id="tablaTapiz" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($resultTapiz->num_rows > 0) {
    while ($row = $resultTapiz->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_tapiz"] . "</td>";
        echo "<td>" . $row["tapiz_nom"] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-primary edit-btn-tapiz' data-toggle='modal' data-target='#modalEditarTapiz' data-id='" . $row['id_tapiz'] . "'><i class='fas fa-edit'></i></button>";
        echo "<button class='delete-btn-tapiz' data-id='" . $row["id_tapiz"] . "'><i class='fas fa-trash'></i></button>";
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
                                                <th>Nombre</th>
                                                <th>Acciones</th>
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

    <!-- Modal para agregar materiales -->
    <div class="modal fade" id="modalAgregarMaterial" tabindex="-1" role="dialog"
        aria-labelledby="modalAgregarMaterialLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarMaterialLabel">Agregar Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarMaterial" action="agregar_material.php" method="post">
                        <div class="form-group">
                            <label for="nombreMaterial">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Material</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar materiales -->
    <div class="modal fade" id="modalEditarMaterial" tabindex="-1" role="dialog" aria-labelledby="modalEditarMaterialLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarMaterialLabel">Editar Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarMaterial" action="editar_eliminar/editarmaterial.php" method="post">
                    <!-- Agrega un input hidden para enviar el ID del material -->
                    <input type="hidden" name="id" id="editMaterialId">
                    <div class="form-group">
                        <label for="editMaterialNombre">Nombre del Material:</label>
                        <input type="text" class="form-control" id="editMaterialNombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para agregar colores -->
    <div class="modal fade" id="modalAgregarColor" tabindex="-1" role="dialog" aria-labelledby="modalAgregarColorLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarColorLabel">Agregar Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarColor" action="agregar_Color.php" method="post">
                        <div class="form-group">
                        <input type="hidden" name="id" id="editMaterialId">
                            <label for="nombreColor">Agregue el Nombre</label>
                            <input type="text" id="nombreColor" name="nombre" required>
                        </div>
                        <!-- Agrega el input de tipo color para seleccionar el color -->
                    
                    <div class="form-group">
                        <label for="colorSeleccionado">Agregue el Color</label>
                        <input type="color" class="form-control" id="colorSeleccionado" name="color">
                    </div>
                        <button type="submit" class="btn btn-primary">Agregar Color</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar Color -->
    <div class="modal fade" id="modalEditarColor" tabindex="-1" role="dialog" aria-labelledby="modalEditarMaterialLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarColorLabel">Editar Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarColor" action="editar_eliminar/editarcolor.php" method="post">
                    <!-- Agrega un input hidden para enviar el ID del material -->
                    <input type="hidden" name="id" id="editColorId">
                    <div class="form-group">
                        <label for="editColorNombre">Nombre del Material:</label>
                        <input type="text" class="form-control" id="editColorNombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="colorEditar">Color:</label>
                        <input type="color" class="form-control" id="colorEditar" name="colorEditar">
                    </div>
                    <input type="hidden" id="idColorEditar" name="idColorEditar">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para agregar Tapices -->
    <div class="modal fade" id="modalAgregarTapiz" tabindex="-1" role="dialog" aria-labelledby="modalAgregarTapizLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarTapizLabel">Agregar Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarTapiz" action="agregar_Tapiz.php" method="post">
                        <div class="form-group">
                            <label for="nombreTapiz">Nombre:</label>
                            <input type="text" id="nombreTapiz" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Tapiz</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

      <!-- Modal para editar Tapiz -->
      <div class="modal fade" id="modalEditarTapiz" tabindex="-1" role="dialog" aria-labelledby="modalEditarTapizLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarTapizLabel">Editar Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarTapiz" action="editar_eliminar/editartapiz.php" method="post">
                    <!-- Agrega un input hidden para enviar el ID del material -->
                    <input type="hidden" name="id" id="editTapizId">
                    <div class="form-group">
                        <label for="editTapizNombre">Nombre del Material:</label>
                        <input type="text" class="form-control" id="editTapizNombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>


    

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


    <script src="../plantilla/quixlab-master/plugins/moment/moment.js"></script>
    <script src="../plantilla/quixlab-master/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="../plantilla/quixlab-master/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="../plantilla/quixlab-master/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="../plantilla/quixlab-master/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="../plantilla/quixlab-master/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../plantilla/quixlab-master/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="../plantilla/quixlab-master/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="../plantilla/quixlab-master/js/plugins-init/form-pickers-init.js"></script>


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
        // Inicializa DataTables en la tabla con id "tablaMaterial"
        $('#tablaMaterial').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "dom": 'lrtip', // Elimina el cuadro de búsqueda
            "lengthChange": false, // No permite cambiar el número de registros mostrados por página
            "pageLength": 5,
            "info": false // Oculta la leyenda de información
        });

        // Inicializa DataTables en la tabla con id "tablaColor"
        $('#tablaColor').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "dom": 'lrtip', // Elimina el cuadro de búsqueda
            "lengthChange": false, // No permite cambiar el número de registros mostrados por página
            "pageLength": 5,
            "info": false // Oculta la leyenda de información
        });

        // Inicializa DataTables en la tabla con id "tablaTapiz"
        $('#tablaTapiz').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "dom": 'lrtip', // Elimina el cuadro de búsqueda
            "lengthChange": false, // No permite cambiar el número de registros mostrados por página
            "pageLength": 5,
            "info": false // Oculta la leyenda de información
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#formAgregarMaterial').submit(function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            // Obtener los datos del formulario
            var nombre = $('#nombre').val();

            // Enviar los datos del formulario mediante AJAX
            $.ajax({
                url: 'editar_eliminar/agregar_material.php', // URL del script PHP para agregar el material
                type: 'POST', // Método de envío de datos
                data: {
                    nombre: nombre
                }, // Datos a enviar al servidor
                success: function() { // Función a ejecutar si la solicitud tiene éxito
                    alert('Material agregado correctamente');
                    // Redirige a la página categorias.php
                    window.location.href = 'categorias.php';
                },
                error: function(xhr, status,
                error) { // Función a ejecutar si hay un error en la solicitud
                    alert('Error en la solicitud AJAX: ' + error);
                }
            });
        });
    });
    </script>


    <script>
    $(document).ready(function() {
        $('#formAgregarColor').submit(function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            // Obtener los datos del formulario
            var nombre = $('#nombreColor').val();
            var color = $('#colorSeleccionado').val(); // Obtener el valor hexadecimal del color seleccionado

            // Enviar los datos del formulario mediante AJAX
            $.ajax({
                url: 'editar_eliminar/agregar_Color.php', // URL del script PHP para agregar el material
                type: 'POST', // Método de envío de datos
                data: {
                    nombre: nombre,
                    color: color // Enviar también el valor hexadecimal del color

                }, // Datos a enviar al servidor
                success: function() { // Función a ejecutar si la solicitud tiene éxito
                    alert('Color agregado correctamente');
                    // Redirige a la página categorias.php
                    window.location.href = 'categorias.php';
                },
                error: function(xhr, status,
                error) { // Función a ejecutar si hay un error en la solicitud
                    alert('Error en la solicitud AJAX: ' + error);
                }
            });
        });
    });
    </script>


    <script>
    $(document).ready(function() {
        $('#formAgregarTapiz').submit(function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            // Obtener los datos del formulario
            var nombre = $('#nombreTapiz').val();

            // Enviar los datos del formulario mediante AJAX
            $.ajax({
                url: 'editar_eliminar/agregar_Tapiz.php', // URL del script PHP para agregar el material
                type: 'POST', // Método de envío de datos
                data: {
                    nombre: nombre
                }, // Datos a enviar al servidor
                success: function() { // Función a ejecutar si la solicitud tiene éxito
                    alert('Tapiz agregado correctamente');
                    // Redirige a la página categorias.php
                    window.location.href = 'categorias.php';
                },
                error: function(xhr, status,
                error) { // Función a ejecutar si hay un error en la solicitud
                    alert('Error en la solicitud AJAX: ' + error);
                }
            });
        });
    });
    </script>

<!-- BOTONES DE ACCIONES DE MATERIAL -->
   <script>
   $(document).ready(function() {
    // Manejar el clic en los botones de edición
    $('.edit-btn-material').click(function() {
        // Obtener el ID del material
        var id = $(this).data('id');
        // Obtener el nombre del material
        var nombre = $(this).closest('tr').find('td:nth-child(2)').text();
        // Asignar los valores al formulario del modal
        $('#editMaterialId').val(id);
        $('#editMaterialNombre').val(nombre);
    });
});
   </script>

   <script>
    $(document).ready(function() {
    $('#formEditarMaterial').submit(function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los datos del formulario
        var id = $('#editMaterialId').val();
        var nombre = $('#editMaterialNombre').val();

        // Enviar los datos del formulario mediante AJAX
        $.ajax({
            url: 'editar_eliminar/editarmaterial.php', // URL del script PHP para editar el material
            type: 'POST', // Método de envío de datos
            data: {
                id: id,
                nombre: nombre
            }, // Datos a enviar al servidor
            success: function(response) { // Función a ejecutar si la solicitud tiene éxito
                alert('Material actualizado correctamente');
                // Redirige a la página categorias.php
                window.location.href = 'categorias.php';
            },
            error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                alert('Error en la solicitud AJAX: ' + error);
            }
        });
    });
});
   </script>
   

    <!-- BOTONES DE ACCIONES DE COLOR -->
   <script>
   $(document).ready(function() {
    // Manejar el clic en los botones de edición
    $('.edit-btn-color').click(function() {
        // Obtener el ID del color
        var id = $(this).data('id');
        // Obtener el nombre del color
        var nombre = $(this).closest('tr').find('td:nth-child(2)').text();
        // Obtener el color hexadecimal desde el botón de edición
        var color1 = $(this).data('color');
        // Asignar los valores al formulario del modal
        $('#editColorId').val(id);
        $('#editColorNombre').val(nombre);
        $('#colorEditar').val(color1); // Establecer el color en el input de tipo "color"
    });
});
   </script>

   <script>
    $(document).ready(function() {
    $('#formEditarColor').submit(function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los datos del formulario
        var id = $('#editColorId').val();
        var nombre = $('#editColorNombre').val();
        var color = $('#colorEditar').val(); // Nuevo color seleccionado por el usuario

        // Enviar los datos del formulario mediante AJAX
        $.ajax({
            url: 'editar_eliminar/editarcolor.php', // URL del script PHP para editar el material
            type: 'POST', // Método de envío de datos
            data: {
                id: id,
                nombre: nombre,
                color: color // Incluye el nuevo color en los datos a enviar al servidor
            }, // Datos a enviar al servidor
            success: function(response) { // Función a ejecutar si la solicitud tiene éxito
                alert('Color actualizado correctamente');
                // Redirige a la página categorias.php
                window.location.href = 'categorias.php';
            },
            error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                alert('Error en la solicitud AJAX: ' + error);
            }
        });
    });
});
   </script>
  <!-- BOTONES DE ACCIONES DE TAPIZ -->
  <script>
   $(document).ready(function() {
    // Manejar el clic en los botones de edición
    $('.edit-btn-tapiz').click(function() {
        // Obtener el ID del tapiz
        var id = $(this).data('id');
        // Obtener el nombre del tapiz
        var nombre = $(this).closest('tr').find('td:nth-child(2)').text();
        // Asignar los valores al formulario del modal
        $('#editTapizId').val(id);
        $('#editTapizNombre').val(nombre);
    });
});

   </script>

   <script>
    $(document).ready(function() {
    $('#formEditarTapiz').submit(function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los datos del formulario
        var id = $('#editTapizId').val();
        var nombre = $('#editTapizNombre').val();

        // Enviar los datos del formulario mediante AJAX
        $.ajax({
            url: 'editar_eliminar/editartapiz.php', // URL del script PHP para editar el material
            type: 'POST', // Método de envío de datos
            data: {
                id: id,
                nombre: nombre
            }, // Datos a enviar al servidor
            success: function(response) { // Función a ejecutar si la solicitud tiene éxito
                alert('Tapiz actualizado correctamente');
                // Redirige a la página categorias.php
                window.location.href = 'categorias.php';
            },
            error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                alert('Error en la solicitud AJAX: ' + error);
            }
        });
    });
});
   </script>

<script>

// Manejar el clic en los botones de eliminar
document.querySelectorAll('.delete-btn-material').forEach(button => {
    button.addEventListener('click', function() {
        let id = this.getAttribute('data-id');
        if (confirm('¿Estás seguro de que deseas eliminar este Material?')) {
            // Realizar una solicitud AJAX para eliminar la categoría
            fetch('editar_eliminar/eliminarmaterial.php', {
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
                    alert('Error al eliminar el Material.');
                }
            });
        }
    });
});
</script>


   <script>

// Manejar el clic en los botones de eliminar
document.querySelectorAll('.delete-btn-color').forEach(button => {
    button.addEventListener('click', function() {
        let id = this.getAttribute('data-id');
        if (confirm('¿Estás seguro de que deseas eliminar este Color?')) {
            // Realizar una solicitud AJAX para eliminar la categoría
            fetch('editar_eliminar/eliminarcolor.php', {
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
                    alert('Error al eliminar el Color.');
                }
            });
        }
    });
});
</script>


 <script>

    // Manejar el clic en los botones de eliminar
    document.querySelectorAll('.delete-btn-tapiz').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
                // Realizar una solicitud AJAX para eliminar la categoría
                fetch('editar_eliminar/eliminartapiz.php', {
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
    </script>



</body>

</html>