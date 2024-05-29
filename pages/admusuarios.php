<?php
session_start();

// Establece la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si se recibe una solicitud POST para actualizar un usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_usuario'])) {
        $id = $_POST['id_usuario'];
        $nombre_completo = $_POST['nombre_completo'];
        $email = $_POST['email'];
        $nom_usuario = $_POST['nom_usuario'];

        // Actualizar el registro en la base de datos
        $update_sql = "UPDATE usuarios SET nombre_completo='$nombre_completo', email='$email', nom_usuario='$nom_usuario' WHERE Id_usuario=$id";
        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['success_message'] = "Registro actualizado exitosamente";
        } else {
            $_SESSION['error_message'] = "Error actualizando el registro: " . $conn->error;
        }
    } elseif (isset($_POST['delete_id_usuario'])) {
        $id = $_POST['delete_id_usuario'];

        // Eliminar el registro de la base de datos
        $delete_sql = "DELETE FROM usuarios WHERE Id_usuario=$id";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success_message'] = "Usuario eliminado exitosamente";
        } else {
            $_SESSION['error_message'] = "Error eliminando el usuario: " . $conn->error;
        }
    }

    header("Location: admusuarios.php"); // Redirigir para evitar reenvío de formularios
    exit();
}

// Consulta SQL para obtener todos los registros de la tabla "usuarios"
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../plantilla/quixlab-master/images/favicon.png">
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">
    <link href="../plantilla/quixlab-master/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <style>
        /* CSS personalizado */
        .edit-btn, .delete-btn {
            margin-right: 5px;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn { background-color: #28a745; color: white; }
        .delete-btn { background-color: #dc3545; color: white; }
        .edit-btn:hover, .delete-btn:hover { color: #0056b3; }
    </style>
</head>
<body>
    <div id="main-wrapper">
        <?php include('layouts/all.php'); ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Usuarios en el Sistema</h4>
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
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["Id_usuario"] . "</td>";
                                                    echo "<td>" . $row["nombre_completo"] . "</td>";
                                                    echo "<td>" . $row["email"] . "</td>";
                                                    echo "<td>" . $row["nom_usuario"] . "</td>";
                                                    echo "<td>
                                                        <button type='button' class='btn btn-success edit-btn' data-id='" . $row['Id_usuario'] . "' data-nombre='" . $row['nombre_completo'] . "' data-email='" . $row['email'] . "' data-usuario='" . $row['nom_usuario'] . "' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit'></i></button>
                                                        <button type='button' class='btn btn-danger delete-btn' data-id='" . $row['Id_usuario'] . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash-alt'></i></button>
                                                    </td>";
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
                        <form id="editForm" method="post" action="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_usuario" id="modal_id_usuario">
                                <div class="form-group">
                                    <label for="modal_nombre_completo">Nombre Completo:</label>
                                    <input type="text" name="nombre_completo" id="modal_nombre_completo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="modal_email">Email:</label>
                                    <input type="email" name="email" id="modal_email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="modal_nom_usuario">Nombre de Usuario:</label>
                                    <input type="text" name="nom_usuario" id="modal_nom_usuario" class="form-control" required>
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
                        <form id="deleteForm" method="post" action="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="delete_id_usuario" id="delete_id_usuario">
                                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="copyright">
                    <p>Copyright © Designed & Developed by <a href="#" target="_blank">Quixlab</a> 2018</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productos').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });

            // Pasar datos al modal de edición
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nombre = button.data('nombre');
                var email = button.data('email');
                var usuario = button.data('usuario');

                var modal = $(this);
                modal.find('#modal_id_usuario').val(id);
                modal.find('#modal_nombre_completo').val(nombre);
                modal.find('#modal_email').val(email);
                modal.find('#modal_nom_usuario').val(usuario);
            });

            // Pasar datos al modal de eliminación
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                var modal = $(this);
                modal.find('#delete_id_usuario').val(id);
            });

            <?php if(isset($_SESSION['success_message'])): ?>
                alert('<?php echo $_SESSION['success_message']; ?>');
                <?php unset($_SESSION['success_message']); ?>
            <?php elseif(isset($_SESSION['error_message'])): ?>
                alert('<?php echo $_SESSION['error_message']; ?>');
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
