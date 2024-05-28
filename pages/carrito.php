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
        .product_row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .product_image {
            width: 30%;
            max-width: 150px;
            margin-right: 20px;
        }

        .product_image img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product_details {
            flex: 1;
        }

        .product_actions {
            margin-left: 20px;
        }

        .quantity_buttons {
            display: flex;
            align-items: center;
        }

        .quantity_buttons button {
            margin: 0 5px;
        }

        .order_summary {
            margin-top: 30px;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .order_total {
            text-align: left;
            font-size: 18px;
        }

        .btn-danger {
            padding: 5px 10px;
            font-size: 1em;
        }

        .btn-danger .bi {
            font-size: 18px;
        }
        .product_title{
            cursor: pointer;
            text-decoration: none;
            color: black;
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
                <div class="cart_section" style="padding-top: 120px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="cart_container">
                                    <h1 class="text-center mt-5">Carrito de Compras</h1>
                                    <?php $total = 0; ?>
                                    <?php if (!empty($_SESSION['CARRITO'])) : ?>
                                        <?php foreach ($_SESSION['CARRITO'] as $producto) : ?>
                                            <div class="product_row">
                                                <div class="product_image">
                                                    <img src="../assets/images/uploads/<?php echo $producto['image']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                                    <a href="producto.php?id=<?php echo urlencode(openssl_encrypt($producto['id'], COD, KEY)); ?>"></a>
                                                </div>
                                                <div class="product_details">
                                                    <a href="producto.php?id=<?php echo urlencode(openssl_encrypt($producto['id'], COD, KEY)); ?>">
                                                        <h4 class="product_title""><?php echo $producto['nombre']; ?></h4>
                                                    </a>
                                                    
                                                    <p><?php echo $producto['descripcion_prod']; ?></p>
                                                    <div class="quantity_buttons">
                                                        <form action="" method="POST" style="display: inline;">
                                                            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                                            <input type="hidden" name="cantidad" value="<?php echo $producto['cantidad'] - 1; ?>">
                                                            <button name="btn-accion"  value="Actualizar" type="submit" class="btn btn-secondary" >-</button>
                                                        </form>
                                                        <p style="display: inline; margin: 0 10px;"><?php echo $producto['cantidad']; ?></p>
                                                        <form action="" method="POST" style="display: inline;">
                                                            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                                            <input type="hidden" name="cantidad" value="<?php echo  $producto['cantidad'] + 1; ?>">
                                                            <button name="btn-accion"  value="Actualizar" type="submit"  class="btn btn-secondary">+</button>
                                                        </form>
                                                    </div>
                                                    <p>Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                                                    <p>Total: $<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></p>
                                                </div>
                                                <div class="product_actions">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                                        <button class="btn btn-danger btn-lg d-flex align-items-center justify-content-center" name="btn-accion" value="Eliminar" type="submit">
                                                            <i class="bi bi-trash fs-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="alert alert-success">
                                            No hay productos en el carrito.
                                        </div>
                                    <?php endif; ?>
                                    <div class="cart_buttons">
                                        <button type="button" class="btn "><a href="../index.php"><i class="bi bi-arrow-left"></i>Continuar comprando</a></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="padding-top: 90px;">
                                <div class="order_summary">
                                    <h4>Resumen del Pedido</h4>
                                    <div class="order_total mt-4">
                                        <div class="order_total_title">Sub-total:</div>
                                        <div class="order_total_amount">$<?php echo number_format($total, 2); ?></div>
                                    </div>
                                    <div class="order_total mt-4">
                                        <div class="order_total_title">Envío:</div>
                                        <div class="order_total_amount">$<?php $envio = 10.00; echo number_format($envio, 2); ?></div>
                                    </div>
                                    <div class="order_total mt-4">
                                        <div class="order_total_title">Impuesto:</div>
                                        <div class="order_total_amount">$<?php $impuesto = $total * 0.16; echo number_format($impuesto, 2); ?></div>
                                    </div>
                                    <div class="order_total mt-4">
                                        <div class="order_total_title">Total:</div>
                                        <div class="order_total_amount">$<?php $total_general = $total + $envio + $impuesto; echo number_format($total_general, 2); ?></div>
                                    </div>
                                    <form action="" method="POST">
                                        <button class="btn btn-success btn-lg btn-block" name="btn-accion" value="buy" type="submit">Ir a Pagar</button>
                                    </form>
                                    <div class="payment_methods mt-4">
                                        <p>Aceptamos:</p>
                                        <img src="../assets/images/visa.png" alt="Visa" style="width:50px; margin-right:10px;">
                                        <img src="../assets/images/paypal.png" alt="PayPal" style="width:50px; margin-right:10px;">
                                        <!-- Agrega más métodos de pago según sea necesario -->
                                    </div>
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
    <script src="../assets/js/loader.js"></script>
</body>
</html>