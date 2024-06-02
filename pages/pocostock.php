<?php
// traemos la sesion del usuario
include "../controllers/user_session.php";
// validar si no es ADMIN bloquearle esta pagina
$userEmail = $user['email'];
if (isset($_SESSION['user_id'])) {
    $query = $conn->prepare("SELECT rol FROM usuarios WHERE email='$userEmail'");
    $query->execute();
    // Fetch the result row as an associative array
    $row = $query->fetch(PDO::FETCH_ASSOC);
    // REGRESA EL ROL DEL USUARIO
    $role = $row['rol'];

    if ($role == 'admin') {
        //SI ES ADMIN

    } else {
        //NO ES ADMIN
        header('Location: ../index.php');
    }
} else {
    //NO ESTA REGISTRADO O LOGUEADO
    header('Location: ../login.php');
}

try {
    // Consulta para obtener los productos con poco stock es decir stock < 10
    $sql = "SELECT productos.*, departamentos.departamento_nom, proveedores.proveedor_nom ,color.color_nom, material.material_nom, tapiz.tapiz_nom 
            FROM productos 
            LEFT JOIN departamentos ON productos.id_departamento = departamentos.id_departamento
            LEFT JOIN proveedores ON productos.proveedor = proveedores.id_proveedor
            LEFT JOIN color ON productos.id_color = color.id_color
            LEFT JOIN material ON productos.id_material = material.id_material
            LEFT JOIN tapiz ON productos.id_tapiz = tapiz.id_tapiz
            WHERE stock_prod < 10";
    $stmt = $conn->query($sql);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener todos los departamentos, colores, materiales y tapices
    $sql_departamentos = "SELECT * FROM departamentos";
    $sql_colores = "SELECT * FROM color";
    $sql_materiales = "SELECT * FROM material";
    $sql_tapices = "SELECT * FROM tapiz";

    $stmt_departamentos = $conn->query($sql_departamentos);
    $stmt_colores = $conn->query($sql_colores);
    $stmt_materiales = $conn->query($sql_materiales);
    $stmt_tapices = $conn->query($sql_tapices);

    $departamentos = $stmt_departamentos->fetchAll(PDO::FETCH_ASSOC);
    $colores = $stmt_colores->fetchAll(PDO::FETCH_ASSOC);
    $materiales = $stmt_materiales->fetchAll(PDO::FETCH_ASSOC);
    $tapices = $stmt_tapices->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// ACTUALIZAMOS LOS PRODUCTOS
// Código para manejar la actualización del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $productoId = $_POST['productoId'];
        $nombre = $_POST['nombre_prod'];
        $descripcion = $_POST['descripcion_prod'];
        $precio = $_POST['precio_prod'];
        $departamento = $_POST['id_departamento'];
        $stock = $_POST['stock_prod'];
        $proveedor = $_POST['proveedor'];
        $marca = $_POST['marca'];
        $color = $_POST['id_color'];
        $material = $_POST['id_material'];
        $tapiz = $_POST['id_tapiz'];

        $sql_update = "UPDATE productos SET 
                        nombre_prod = ?, 
                        descripcion_prod = ?, 
                        precio_prod = ?, 
                        id_departamento = ?, 
                        stock_prod = ?, 
                        proveedor = ?, 
                        marca = ?, 
                        id_color = ?, 
                        id_material = ?, 
                        id_tapiz = ? 
                    WHERE id_producto = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([$nombre, $descripcion, $precio, $departamento, $stock, $proveedor, $marca, $color, $material, $tapiz, $productoId]);

        // Responder con éxito en formato JSON para que JavaScript lo procese
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
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
    <link href="../plantilla/quixlab-master/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
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
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom CSS for the "agregar" card -->
    <style>
        .edit-btn-stock {
            margin-right: 5px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-btn-stock:hover {
            color: #0056b3;
        }

        .modal-dialog {
            max-width: 800px;
        }
    </style>

</head>

<body>

    <!-- Preloader start -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <?php include 'layouts/all.php'; ?>

        <!-- Content body start -->
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
                                                <th>Marca</th>
                                                <th>Editar producto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($productos)) {
                                                foreach ($productos as $producto) {
                                                    echo "<tr>";
                                                    echo "<td>" . $producto["id_producto"] . "</td>";
                                                    echo "<td>" . $producto["nombre_prod"] . "</td>";
                                                    echo "<td>$" . $producto["precio_prod"] . "</td>";
                                                    echo "<td>" . $producto["departamento_nom"] . "</td>";
                                                    echo "<td>" . $producto["stock_prod"] . "</td>";
                                                    echo "<td>" . $producto["proveedor_nom"] . "</td>";
                                                    echo "<td>" . $producto["marca"] . "</td>";
                                                    echo "<td>";
                                                    echo "<button class='btn btn-primary edit-btn-stock' data-toggle='modal' data-target='#modalEditarStock' data-id='" . $producto['id_producto'] . "' data-nombre='" . $producto['nombre_prod'] . "' data-descripcion='" . $producto['descripcion_prod'] . "' data-precio='" . $producto['precio_prod'] . "' data-departamento='" . $producto['id_departamento'] . "' data-stock='" . $producto['stock_prod'] . "' data-proveedor='" . $producto['proveedor'] . "' data-marca='" . $producto['marca'] . "' data-color='" . $producto['id_color'] . "' data-material='" . $producto['id_material'] . "' data-tapiz='" . $producto['id_tapiz'] . "'><i class='fas fa-edit'></i></button>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>0 resultados</td></tr>";
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
                                                <th>Editar Producto</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- Content body end -->

        <!-- Footer start -->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!-- Footer end -->
    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
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

    <!-- Modal para editar el producto -->
    <div class="modal fade" id="modalEditarStock" tabindex="-1" role="dialog" aria-labelledby="modalEditarStockLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarStockLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarStock">
                        <div class="form-group">
                            <label for="nombre_prod">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="nombre_prod" name="nombre_prod">
                        </div>
                        <div class="form-group">
                            <label for="descripcion_prod">Descripción:</label>
                            <textarea class="form-control" id="descripcion_prod" name="descripcion_prod"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio_prod">Precio:</label>
                            <input type="number" step="0.01" class="form-control" id="precio_prod" name="precio_prod">
                        </div>
                        <div class="form-group">
                            <label for="id_departamento">Departamento:</label>
                            <select class="form-control" id="id_departamento" name="id_departamento">
                                <?php foreach ($departamentos as $departamento) {
                                    echo "<option value='" . $departamento['id_departamento'] . "'>" . $departamento['departamento_nom'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock_prod">Stock:</label>
                            <input type="number" class="form-control" id="stock_prod" name="stock_prod">
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor:</label>
                            <input type="text" class="form-control" id="proveedor" name="proveedor">
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca">
                        </div>
                        <div class="form-group">
                            <label for="id_color">Color:</label>
                            <select class="form-control" id="id_color" name="id_color">
                                <?php foreach ($colores as $color) {
                                    echo "<option value='" . $color['id_color'] . "'>" . $color['color_nom'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_material">Material:</label>
                            <select class="form-control" id="id_material" name="id_material">
                                <?php foreach ($materiales as $material) {
                                    echo "<option value='" . $material['id_material'] . "'>" . $material['material_nom'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_tapiz">Tapiz:</label>
                            <select class="form-control" id="id_tapiz" name="id_tapiz">
                                <?php foreach ($tapices as $tapiz) {
                                    echo "<option value='" . $tapiz['id_tapiz'] . "'>" . $tapiz['tapiz_nom'] . "</option>";
                                } ?>
                            </select>
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
        $(document).ready(function() {
            // Cuando se hace clic en un botón de editar
            $('.edit-btn-stock').click(function() {
                // Obtiene los datos del producto desde los atributos de datos
                var productoId = $(this).data('id');
                var nombre = $(this).data('nombre');
                var descripcion = $(this).data('descripcion');
                var precio = $(this).data('precio');
                var departamento = $(this).data('departamento');
                var stock = $(this).data('stock');
                var proveedor = $(this).data('proveedor');
                var marca = $(this).data('marca');
                var color = $(this).data('color');
                var material = $(this).data('material');
                var tapiz = $(this).data('tapiz');

                // Actualiza los campos del formulario en el modal con la información del producto
                $('#productoId').val(productoId);
                $('#nombre_prod').val(nombre);
                $('#descripcion_prod').val(descripcion);
                $('#precio_prod').val(precio);
                $('#id_departamento').val(departamento);
                $('#stock_prod').val(stock);
                $('#proveedor').val(proveedor);
                $('#marca').val(marca);
                $('#id_color').val(color);
                $('#id_material').val(material);
                $('#id_tapiz').val(tapiz);
            });

            $('#formEditarStock').submit(function(event) {
                // Evita el envío del formulario por defecto
                event.preventDefault();

                // Obtiene los datos del formulario
                var formData = $(this).serialize();

                // Realiza la solicitud AJAX
                $.ajax({
                    url: 'pocostock.php', // La URL del archivo PHP que manejará la actualización del stock
                    type: 'POST', // Método de la solicitud
                    data: formData, // Datos a enviar al servidor
                    success: function(response) {
                        // Maneja la respuesta del servidor
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Producto actualizado exitosamente',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Recarga la página para actualizar la tabla de productos
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores de la solicitud
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al actualizar el producto: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>



</body>

</html>