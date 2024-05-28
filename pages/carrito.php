<?php
include "../controllers/user_session.php";
include '../controllers/carrito.php';


?>

<!doctype html>
<html lang="es">

<head>
    <title>Carrito de Compras - Muebleria Alvarez</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Wish shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/bootstrap4/bootstrap.min.css">
    <link href="plantilla/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/OwlCarousel2-2.2.1/animate.css">
    <link href="../plantilla/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/responsive.css">
    <link rel="stylesheet" href="../assets/css/loader.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .product_image{
            width: 100%;
            height: 250px; /* Altura deseada para todos los cuadros de productos */
            overflow: hidden; /* Para recortar las imágenes más grandes */
            position: relative; /* Para centrar verticalmente la imagen */
        }
    </style>
</head>

<body>
    <!--LOADER -->
    <div class="loader">
        <div class="loader-large"></div>
        <div class="loader-small"></div>
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include "layouts/headerIN.php"; ?>

        <!-- Main wrapper -->
        <div class="body-wrapper">
            <div class="content-wrapper">

                <!-- Carrito -->
                <div class="cart_section" style="padding-top: 150px;">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="cart_container">
                                    <h1 class="text-center mt-5">Carrito de Compras</h1>
                                    <?php $total = 0; ?>
                                    <?php if (!empty($_SESSION['CARRITO'])) : ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Productos</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Acciones</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total = 0; ?>
                                                <?php foreach ($_SESSION['CARRITO'] as $producto) : ?>
                                                    <tr>
                                                        <td><img src="../assets/images/uploads/<?php echo $producto['image']; ?>" alt="<?php echo $producto['nombre']; ?>" class="product_image"></td>
                                                        <td><?php echo $producto['nombre']; ?></td>
                                                        <td><?php echo $producto['cantidad']; ?></td>
                                                        
                                                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                                                <button class="btn btn-danger" name="btn-accion" value="Eliminar" type="submit">Eliminar</button>
                                                            </form>
                                                        </td>
                                                        <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                                                    </tr>
                                                    <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="5" align="right">
                                                        <h3>Total</h3>
                                                    </td>
                                                    <td align="right">
                                                        <h3>$<?php echo number_format($total, 2); ?></h3>
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form action="" method="POST">
                                            <button class="btn btn-success btn-lg btn-block" name="btn-accion" value="buy" type="submit">Comprar</button>
                                        </form>
                                    <?php else : ?>
                                        <div class="alert alert-success">
                                            No hay productos en el carrito.
                                        </div>
                                    <?php endif; ?>

                                    </ul>
                                </div>
                                <!-- Order Total -->
                                <div class="order_total mt-4">
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Sub-total:</div>
                                        <div class="order_total_amount">$<?php echo number_format($total, 2); ?></div>
                                    </div>
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Envío:</div>
                                        <div class="order_total_amount">$<?php $envio = 10.00; echo number_format($envio, 2); ?></div>
                                    </div>
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Impuesto:</div>
                                        <div class="order_total_amount">$<?php $impuesto = $total * 0.15; echo number_format($impuesto, 2); ?></div>
                                    </div>
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Total:</div>
                                        <div class="order_total_amount">$<?php $total_general = $total + $envio + $impuesto; echo number_format($total_general, 2); ?></div>
                                    </div>
                                </div>
                                <div class="cart_buttons">
                                    <button type="button" class="btn btn-outline-success"><a href="../index.php">Continuar comprando</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br>
    <?php include "layouts/footer.php"; ?>

    </div>

    <script src="../assets/js/loader.js"></script>
</body>

</html>