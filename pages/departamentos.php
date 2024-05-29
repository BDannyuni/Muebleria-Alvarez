<?php
//traemos la sesion del usuario
include "../controllers/user_session.php";

// Consulta SQL para obtener todos los registros de la tabla "departamentos"
$sql = "SELECT * FROM departamentos";
$stmt = $conn->query($sql);
$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agregar departamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_departamento']) && isset($_POST['estado_departamento'])) {
        // Agregar nuevo departamento
        $nombre_departamento = $_POST['nombre_departamento'];
        $estado_departamento = $_POST['estado_departamento'];

        $sql = "INSERT INTO departamentos (departamento_nom, Estado) VALUES (:nombre_departamento, :Estado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_departamento', $nombre_departamento);
        $stmt->bindParam(':Estado', $estado_departamento);

        if ($stmt->execute()) {
            header("Location: departamentos.php"); // Redirige a la página principal después de agregar.
            exit();
        } else {
            echo "Error al agregar el departamento.";
        }
    } elseif (isset($_POST['id_departamento']) && isset($_POST['departamento_nom']) && isset($_POST['Estado'])) {
        // Editar departamento existente
        $id_departamento = $_POST['id_departamento'];
        $nombre_departamento = $_POST['departamento_nom'];
        $estado_departamento = $_POST['Estado'];

        $sql = "UPDATE departamentos SET departamento_nom = :departamento_nom, Estado = :Estado WHERE id_departamento = :id_departamento";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_departamento', $id_departamento);
        $stmt->bindParam(':departamento_nom', $nombre_departamento);
        $stmt->bindParam(':Estado', $estado_departamento);

        if ($stmt->execute()) {
            header("Location: departamentos.php"); // Redirige a la página principal después de editar.
            exit();
        } else {
            echo "Error al editar el departamento.";
        }
    } elseif (isset($_POST['delete_id_departamento'])) {
        // Eliminar departamento
        $id_departamento = $_POST['delete_id_departamento'];

        $sql = "DELETE FROM departamentos WHERE id_departamento = :id_departamento";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_departamento', $id_departamento);

        if ($stmt->execute()) {
            header("Location: departamentos.php"); // Redirige a la página principal después de eliminar.
            exit();
        } else {
            echo "Error al eliminar el departamento.";
        }
    }
}
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
                                                <th>Departamento</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($departamentos as $departamento) : ?>
                                                <tr>
                                                    <td><?php echo $departamento['id_departamento']; ?></td>
                                                    <td><?php echo $departamento['departamento_nom']; ?></td>
                                                    <td><?php echo $departamento['Estado']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-success edit-btn" data-id="<?php echo $departamento['id_departamento']; ?>" data-nombre="<?php echo $departamento['departamento_nom']; ?>" data-estado="<?php echo $departamento['Estado']; ?>" data-toggle="modal" data-target="#editModal">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger delete-btn" data-id="<?php echo $departamento['id_departamento']; ?>" data-toggle="modal" data-target="#deleteModal">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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
                                    <div class="text-center">
                                        <h4 class="card-title">Agregar un nuevo Departamento</h4>
                                    </div><br>
                                    <form action="departamentos.php" method="post">
                                        <label for="nombre_departamento">Nombre del Departamento:</label>
                                        <input type="text" id="nombre_departamento" name="nombre_departamento" required>

                                        <label for="estado_departamento">Estado del Departamento:</label>
                                        <input type="text" id="estado_departamento" name="estado_departamento">

                                        <input type="submit" value="Agregar Departamento">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para editar -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="editForm" method="post" action="departamentos.php">
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

                <script>
                    $(document).ready(function() {
                        $('#productos').DataTable({
                            language: {
                                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                            }
                        });

                        $('.edit-btn').on('click', function() {
                            let id = $(this).data('id');
                            let nombre = $(this).data('nombre');
                            let estado = $(this).data('estado');

                            $('#modal_id_departamento').val(id);
                            $('#modal_departamento_nom').val(nombre);
                            $('#modal_Estado').val(estado);
                        });

                        $('.delete-btn').on('click', function() {
                            let id = $(this).data('id');
                            $('#delete_id_departamento').val(id);
                        });
                    });
                </script>
</body>

</html>