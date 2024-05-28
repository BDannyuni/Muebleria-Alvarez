<?php 
include "../controllers/user_session.php";
include '../controllers/carrito.php';

if (isset($_GET['id'])) {
    $id_producto = openssl_decrypt($_GET['id'], COD, KEY);
    
    if ($id_producto === false || !is_numeric($id_producto)) {
        #echo "ID de producto incorrecto o alterado.";
        exit;
    }

    #echo "ID de producto: " . htmlspecialchars($id_producto);
    
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id_producto = :id_producto");
    $stmt->bindParam(':id_producto', $id_producto);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "Producto no encontrado";
        exit;
    }
} else {
    echo "ID de producto no proporcionado";
    exit;
}
?>

<!doctype html>
<html lang="es">

<head>
<title><?php echo $producto['nombre_prod']; ?> - Muebleria Alvarez</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Detalle del producto">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/bootstrap4/bootstrap.min.css">
    <link href="../plantilla/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/responsive.css">
    <link rel="stylesheet" href="../assets/css/loader.css">
</head>

<body>
    <!--LOADER -->
	<div class="loader">
		<div class="loader-large"></div>
		<div class="loader-small"></div>
	</div>
     <!-- Header -->

    <?php include "layouts/headerIN.php"; ?>

    <!-- Menu -->

    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        <div class="menu_close_container">
            <div class="menu_close">
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="logo menu_mm"><a class="navbar-brand ps-5" href="index.php"><img src="../assets/images/logo.png"
                    alt="logo" height="100px"></a></div>
        <nav class="menu_nav">
            <ul class="menu_mm">
                <li class="menu_mm"><a href="../">Inicio</a></li>
                <li class="menu_mm"><a href="catalogo.php">Catalogo</a></li>
                <li class="menu_mm"><a href="nosotros.php">Sobre Nosotros</a></li>
                <li class="menu_mm"><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        

        <!--  Main wrapper -->
        <div class="body-wrapper" style="padding-top: 130px;">
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product_image">
                                <img src="../assets/images/uploads/<?php echo $producto['image']; ?>" alt="<?php echo $producto['nombre_prod']; ?>" style="width: 100%; height: auto;">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product_details">
                                <h2><?php echo $producto['nombre_prod']; ?></h2>
                                <p><?php echo $producto['descripcion_prod']; ?></p>
                                <p>Disponibles: <?php echo $producto['stock_prod']; ?></p>

                                <div class="product_price">$<?php echo number_format($producto['precio_prod'], 2); ?></div>
                                <form class="add-to-cart-form" action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                                    <input type="hidden" name="image" value="<?php echo openssl_encrypt($producto['image'], COD, KEY); ?>">
                                    <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($producto['nombre_prod'], COD, KEY); ?>">
                                    <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio_prod'], COD, KEY); ?>">
                                    <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
                                    <button name="btn-accion" class="btn btn-primary" value="Agregar" type="submit">Agregar al carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "layouts/footer.php"; ?>

    </div>

    
	<script src="../assets/js/loader.js"></script>
    <script src="../plantilla/styles/bootstrap4/popper.js"></script>
    <script src="../plantilla/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="../plantilla/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="../plantilla/plugins/easing/easing.js"></script>
    <script src="../plantilla/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../plantilla/plugins/colorbox/jquery.colorbox-min.js"></script>
    <script src="../plantilla/js/custom.js"></script>

    <script src="../plantilla/js/jquery-3.2.1.min.js"></script>
    <script src="../plantilla/styles/bootstrap4/popper.js"></script>
    <script src="../plantilla/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="../plantilla/plugins/easing/easing.js"></script>
    <script src="../plantilla/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../plantilla/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="../plantilla/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.js"></script>
    <script src="../plantilla/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="../plantilla/js/categories_custom.js"></script>
</body>
</html>
