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
$sql = "SELECT * FROM usuarios WHERE rol='admin'";
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

    <?php include('layouts/all.php'); ?>
    
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inventario</h4>
                        <div class="table-responsive">
                            <table id="productos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Email</th>
                                        <th>Nombre de Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Itera sobre cada fila del resultado de la consulta y muestra los datos en la tabla
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["Id_usuario"] . "</td>";
                                            echo "<td>" . $row["nombre_completo"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["nom_usuario"] . "</td>";
                                            ?><td>
                                            <button type="button" class="btn btn-success edit-btn" data-id="<?php echo $departamento['Id_usuario']; ?>" data-nombre="<?php echo $departamento['nombre_completo']; ?>" data-estado="<?php echo $departamento['email']; ?>" data-usuario="<?php echo $departamento['nom_usuario']; ?>" data-toggle="modal" data-target="#editModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger delete-btn" data-id="<?php echo $departamento['Id_usuario']; ?>" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td><?php
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>0 resultados</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Email</th>
                                        <th>Nombre de Usuario</th>
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

     <!-- Modal para editar -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="editForm" method="post" action="admusuarios.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar Departamento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_departamento" id="modal_id_departamento">
                                    <div class="form-group">
                                        <label for="modal_departamento_nom">Nombre del Departamento:</label>
                                        <input type="text" name="departamento_nom" id="modal_departamento_nom" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="modal_Estado">Estado del Departamento:</label>
                                        <input type="text" name="Estado" id="modal_Estado" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para eliminar -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="deleteForm" method="post" action="departamentos.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Departamento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="delete_id_departamento" id="delete_id_departamento">
                                    <p>¿Estás seguro de que deseas eliminar este departamento?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
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
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
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