<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos de la tabla "categorias"
$query_categoria = "SELECT id_categoria, categoria_nom FROM categorias";
$result_categoria = mysqli_query($conn, $query_categoria);

// Obtener datos de la tabla "proveedores"
$query_proveedor = "SELECT id_proveedor, proveedor_nom FROM proveedores";
$result_proveedor = mysqli_query($conn, $query_proveedor);

// Obtener datos de la tabla "color"
$query_color = "SELECT id_color, color_nom FROM color";
$result_color = mysqli_query($conn, $query_color);

// Obtener datos de la tabla "material"
$query_material = "SELECT id_material, material_nom FROM material";
$result_material = mysqli_query($conn, $query_material);

// Obtener datos de la tabla "tapiz"
$query_tapiz = "SELECT id_tapiz, tapiz_nom FROM tapiz";
$result_tapiz = mysqli_query($conn, $query_tapiz);
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
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">.

    <style>
        .card-transparent {
            background-color: rgba(128, 128, 128, 0.7); /* Fondo blanco semi-transparente */
            border: none; /* Eliminar borde de la tarjeta */
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
                        <img src="../assets/images/logo-blanco.png" height="32px" style="margin-right:5px;"
                            alt="">Muebleria Alvarez
                    </span>
                </a>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
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
                                <li><a href="catalogo.php">Catálogo</a></li>
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
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../plantilla/quixlab-master/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i>
                                                <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill badge-primary">3</div>
                                            </a>
                                        </li>
                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="resumen.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Resumen</span>
                        </a>
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
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(../assets/images/fondologin.png); 
	background-size:cover;"><br><br>
            
            <!-- row -->

            <div class="container-fluid">
                <div class="col-lg-6  mx-auto">
                    <div class="card card-transparent">
                        <div class="card-body">
                            <H2 class="col-lg-5 mx-auto text-white">Agregar Productos</H2><br>
                            <div class="form-validation">
                                <form class="form-valide" action="upload.php" method="post"
                                    enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="id_producto">ID del Producto <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-7">

                                            <input type="number" class="form-control input-rounded" name="id_producto"
                                                id="id_producto" placeholder="Ingrese el Id del Producto..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="nombre_prod">Nombre del Producto
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control input-rounded" name="nombre_prod" id="nombre_prod"
                                                placeholder="Ingrese el Nombre del Producto..." required>

                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-password">Password <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="val-password"
                                                name="val-password" placeholder="Choose a safe one..">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm
                                            Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="val-confirm-password"
                                                name="val-confirm-password" placeholder="..and confirm it!">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="descripcion_prod">Descripción <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <textarea class="form-control" name="descripcion_prod" id="descripcion_prod"
                                                rows="5" placeholder="Ingrese La Descripción del Producto..."
                                                required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="categoria_prod">Categoría <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                        <select class="form-control input-rounded" type="number" name="categoria_prod" id="categoria_prod"
                                                required>
                                                <option value="">Selecciona una Categoria</option>
                                                <?php while ($row_categoria = mysqli_fetch_assoc($result_categoria)) { ?>
                                                <option value="<?php echo $row_categoria['id_categoria']; ?>">
                                                    <?php echo $row_categoria['categoria_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="precio_prod">Precio <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input class="form-control input-rounded" type="number" step="0.01" name="precio_prod"
                                                id="precio_prod" placeholder="$0.00" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="stock_prod">Stock <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input class="form-control input-rounded" type="number" name="stock_prod" id="stock_prod"
                                                placeholder="Ingrese la cantidad de stock" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="image">Imagen <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <div class="custom-file">
                                                <input type="file" name="image" id="image" accept="image/*"
                                                    class="custom-file-input input-rounded" required>
                                                <label class="custom-file-label">Ingrese la Imagen del Producto</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="proveedor">Proveedor <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                        <select class="form-control input-rounded" type="number" name="proveedor" id="proveedor"
                                                required>
                                                <option value="">Selecciona un Proveedor</option>
                                                <?php while ($row_proveedor = mysqli_fetch_assoc($result_proveedor)) { ?>
                                                <option value="<?php echo $row_proveedor['id_proveedor']; ?>">
                                                    <?php echo $row_proveedor['proveedor_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="marca">Marca <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control input-rounded" name="marca" id="marca"
                                                placeholder="Ingrese la Marca del Producto" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="id_color">Color <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <select class="form-control input-rounded" type="number" name="id_color" id="id_color"
                                                required>
                                                <option value="">Selecciona un Color</option>
                                                <?php while ($row_color = mysqli_fetch_assoc($result_color)) { ?>
                                                <option value="<?php echo $row_color['id_color']; ?>">
                                                    <?php echo $row_color['color_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="id_material">Material <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <select class="form-control input-rounded" type="number" name="id_material"
                                                id="id_material" required>
                                                <option value="">Selecciona un Material</option>
                                                <?php while ($row_material = mysqli_fetch_assoc($result_material)) { ?>
                                                <option value="<?php echo $row_material['id_material']; ?>">
                                                    <?php echo $row_material['material_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-white" for="id_tapiz">Tapiz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <select class="form-control input-rounded" type="number" name="id_tapiz" id="id_tapiz"
                                                required>
                                                <option value="">Selecciona un Tapiz</option>
                                                <?php while ($row_tapiz = mysqli_fetch_assoc($result_tapiz)) { ?>
                                                <option value="<?php echo $row_tapiz['id_tapiz']; ?>">
                                                    <?php echo $row_tapiz['tapiz_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-lg-7 ml-auto">
                                            <button type="submit" class="btn btn-primary" name="submit">Subir
                                                Producto</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>

                <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="id_producto">ID del Producto:</label>
                    <input type="number" name="id_producto" id="id_producto" required><br><br>
                    <label for="nombre_prod">Nombre del Producto:</label>
                    <input type="text" name="nombre_prod" id="nombre_prod" required><br><br>
                    <label for="descripcion_prod">Descripción:</label>
                    <textarea name="descripcion_prod" id="descripcion_prod" required></textarea><br><br>
                    <label for="precio_prod">Precio:</label>
                    <input type="number" step="0.01" name="precio_prod" id="precio_prod" required><br><br>
                    <label for="categoria_prod">Categoría:</label>
                    <input type="text" name="categoria_prod" id="categoria_prod" required><br><br>
                    <label for="stock_prod">Stock:</label>
                    <input type="number" name="stock_prod" id="stock_prod" required><br><br>
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" id="image" accept="image/*" required><br><br>
                    <label for="proveedor">Proveedor:</label>
                    <input type="text" name="proveedor" id="proveedor" required><br><br>
                    <label for="marca">Marca:</label>
                    <input type="text" name="marca" id="marca" required><br><br>
                    <label for="id_color">ID Color:</label>
                    <input type="number" name="id_color" id="id_color" required><br><br>
                    <label for="id_material">ID Material:</label>
                    <input type="number" name="id_material" id="id_material" required><br><br>
                    <label for="id_tapiz">ID Tapiz:</label>
                    <input type="number" name="id_tapiz" id="id_tapiz" required><br><br>
                    <input type="submit" name="submit" value="Subir Producto">
                </form> -->
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
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
</body>

</html>