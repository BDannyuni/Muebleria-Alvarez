<?php
// traer la sesion del usuario
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
$messageError = '';
$messageSuccess = '';
// Obtener datos de la tabla "categorias"
$query_departamento = "SELECT id_departamento, departamento_nom FROM departamentos ";
$stmt_departamento = $conn->query($query_departamento);
$result_departamento = $stmt_departamento->fetchAll();

// Obtener datos de la tabla "proveedores"
$query_proveedor = "SELECT id_proveedor, proveedor_nom FROM proveedores";
$stmt_proveedor = $conn->query($query_proveedor);
$result_proveedor = $stmt_proveedor->fetchAll();

// Obtener datos de la tabla "color"
$query_color = "SELECT id_color, color_nom FROM color";
$stmt_color = $conn->query($query_color);
$result_color = $stmt_color->fetchAll();

// Obtener datos de la tabla "material"
$query_material = "SELECT id_material, material_nom FROM material";
$stmt_material = $conn->query($query_material);
$result_material = $stmt_material->fetchAll();

// Obtener datos de la tabla "tapiz"
$query_tapiz = "SELECT id_tapiz, tapiz_nom FROM tapiz";
$stmt_tapiz = $conn->query($query_tapiz);
$result_tapiz = $stmt_tapiz->fetchAll();


### AGREGAR PRODUCTOS A LA DB ###
if (isset($_POST['submit'])) {
    $nombre_prod = $_POST['nombre_prod'];
    $descripcion_prod = $_POST['descripcion_prod'];
    $precio_prod = $_POST['precio_prod'];
    $id_departamento= $_POST['id_departamento'];
    $stock_prod = $_POST['stock_prod'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $id_color = $_POST['id_color'];
    $id_material = $_POST['id_material'];
    $id_tapiz = $_POST['id_tapiz'];

    // Handle the file upload
    $target_dir = "../assets/images/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image = $_FILES["image"]["name"];
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        #echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
    } else {
        #echo "Sorry, there was an error uploading your file.";
        $messageError = "Error al subir la imagen";
    }
    try {
        // SQL query to insert the product
        $query = "INSERT INTO productos (nombre_prod, descripcion_prod, precio_prod, id_departamento, stock_prod, image, proveedor, marca, id_color, id_material, id_tapiz) 
                  VALUES (:nombre_prod, :descripcion_prod, :precio_prod, :id_departamento, :stock_prod, :image, :proveedor, :marca, :id_color, :id_material, :id_tapiz)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre_prod', $nombre_prod);
        $stmt->bindParam(':descripcion_prod', $descripcion_prod);
        $stmt->bindParam(':precio_prod', $precio_prod);
        $stmt->bindParam(':id_departamento', $id_departamento);
        $stmt->bindParam(':stock_prod', $stock_prod);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':proveedor', $proveedor);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':id_color', $id_color);
        $stmt->bindParam(':id_material', $id_material);
        $stmt->bindParam(':id_tapiz', $id_tapiz);


        if ($stmt->execute()) {
            $messageSuccess = "Producto agregado exitosamente";
        } else {
            $messageError = "Error al agregar el producto";
        }
    } catch (Exception $e) {
        $messageError = "Ocurrio un error inesperado, intente de nuevo";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Muebleria Alvarez - Agregar Productos</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plantilla/quixlab-master/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-container {
            max-width: 100%;
            padding: 20px;
            background-color: rgba(128, 128, 128, 0.7);
            border-radius: 10px;
        }

        .form-group.row {
            margin-bottom: 2rem;
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

        <!-- Nav header start -->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="../index.php">
                    <b class="logo-abbr"><img src="../assets/images/logo-blanco.png" alt=""> </b>
                    <span class="logo-compact"><img src="../assets/images/logo-blanco.png" alt=""></span>
                    <span class="brand-title text-white mt-2">
                        <img src="../assets/images/logo-blanco.png" height="32px" style="margin-right:5px;" alt="">Muebleria Alvarez
                    </span>
                </a>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start  and sidebar -->
        <?php include "layouts/all.php"; ?>
        

        <!-- Content body start -->
        <div class="content-body" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(../assets/images/fondologin.png); 
	background-size:cover;"><br><br>

            <!-- row -->

            <div class="container">
                <h1 class="text-center text-white">Añadir Productos</h1>
                <form class="form-container" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control rounded mb-3" name="nombre_prod" id="nombre_prod" placeholder="Ingrese el Nombre del Producto..." required>
                            </div>
                            <div class="form-group">
                                <select class="form-control rounded mb-3" name="id_departamento" id="id_departamento" required>
                                    <option value="">Selecciona un departamento</option>
                                    <?php foreach ($result_departamento as $row_departamento) { ?>
                                        <option value="<?php echo $row_departamento['id_departamento']; ?>" <?php echo (isset($_POST['id_departamento']) && $_POST['id_departamento'] == $row_departamento['id_departamento']) ? 'selected' : ''; ?>>
                                            <?php echo $row_departamento['departamento_nom']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <textarea class="form-control rounded" name="descripcion_prod" id="descripcion_prod" rows="6" placeholder="Ingrese La Descripción del Producto..." required></textarea>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-lg-4">
                            <input class="form-control rounded" type="number" step="0.01" name="precio_prod" id="precio_prod" placeholder="Ingresa el Precio: $0.00" required>
                        </div>
                        <div class="col-lg-4">
                            <input class="form-control rounded" type="number" name="stock_prod" id="stock_prod" placeholder="Ingrese la cantidad de stock" required>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control rounded" name="proveedor" id="proveedor" required>
                                <option value="">Selecciona un Proveedor</option>
                                <?php foreach ($result_proveedor as $row_proveedor) { ?>
                                    <option value="<?php echo $row_proveedor['id_proveedor']; ?>" <?php echo (isset($_POST['id_proveedor']) && $_POST['id_proveedor'] == $row_proveedor['id_proveedor']) ? 'selected' : ''; ?>>
                                        <?php echo $row_proveedor['proveedor_nom']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-8">
                            <div class="custom-file">
                                <input type="file" name="image" id="image" accept="image/*" class="custom-file-input rounded" required onchange="updateFileName(this)">
                                <label id="imageLabel" class="custom-file-label">Ingrese la Imagen del Producto</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <input type="text" class="form-control rounded" name="marca" id="marca" placeholder="Ingrese la Marca del Producto" required>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control rounded" name="id_color" id="id_color" required>
                                <option value="">Selecciona un Color</option>
                                <?php foreach ($result_color as $row_color) { ?>
                                    <option value="<?php echo $row_color['id_color']; ?>">
                                        <?php echo $row_color['color_nom']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control rounded" name="id_material" id="id_material" required>
                                <option value="">Selecciona un Material</option>
                                <?php foreach ($result_material as $row_material) { ?>
                                    <option value="<?php echo $row_material['id_material']; ?>">
                                        <?php echo $row_material['material_nom']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control rounded" name="id_tapiz" id="id_tapiz" required>
                                <option value="">Selecciona un Tapiz</option>
                                <?php foreach ($result_tapiz as $row_tapiz) { ?>
                                    <option value="<?php echo $row_tapiz['id_tapiz']; ?>">
                                        <?php echo $row_tapiz['tapiz_nom']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary" name="submit">Añadir Producto</button>
                        </div>
                    </div>
                </form>
            </div>
            <br><br><br>

            <?php if (!empty($messageError)) { ?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: '<?php echo $messageError; ?>',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php } ?>
            <?php if (!empty($messageSuccess)) { ?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '<?php echo $messageSuccess; ?>',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php } ?>
        </div>
        <!-- container -->
    </div>
    <!-- Content body end -->

    <!-- Footer start -->
    <div class="footer">
        <div class="copyright">
            <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                2018</p>
        </div>
    </div>
    <!-- Footer end -->
    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <script>
        // evitar que cada que se refresque la pagina el formulario se vuelva a enviar.
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        // Mostrar el nombre del archivo al cargarlo
        function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById("imageLabel").innerText = fileName;
        }
    </script>
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
</body>

</html>