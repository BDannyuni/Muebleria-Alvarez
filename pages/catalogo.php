<?php 
#Incluimos la sesion de usuario y de carrito
include "../controllers/user_session.php";
include '../controllers/carrito.php'
?>
<?php
// traemos la sesion de usuario y carrito
include "../controllers/user_session.php";
include "../controllers/carrito.php";

// Filtros
$whereClauses = [];
$parameters = [];

if (isset($_GET['categoria'])) {
    $categorias = $_GET['categoria'];
    $placeholders = rtrim(str_repeat('?,', count($categorias)), ',');
    $whereClauses[] = "categoria IN ($placeholders)";
    $parameters = array_merge($parameters, $categorias);
}

$whereSql = "";
if (count($whereClauses) > 0) {
    $whereSql = "WHERE " . implode(" AND ", $whereClauses);
}

// Obtener los productos de la base de datos 
$sql = "SELECT * FROM productos $whereSql";
$statement = $conn->prepare($sql);
$statement->execute($parameters);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Categories</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Wish shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/bootstrap4/bootstrap.min.css">
    <link href="../plantilla/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../plantilla/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/categories_responsive.css">
    <style>
        .product_image {
            width: 100%;
            height: 250px;
            /* Altura deseada para todos los cuadros de productos */
            overflow: hidden;
            /* Para recortar las imágenes más grandes */
            position: relative;
            /* Para centrar verticalmente la imagen */
        }

        .product_image img {
            width: auto;
            /* Ajusta el ancho automáticamente para mantener la proporción de la imagen */
            height: 100%;
            /* Estira la imagen para que ocupe toda la altura del contenedor */
            display: block;
            /* Elimina el espacio extra debajo de la imagen */
            margin: auto;
            /* Centra horizontalmente */
            position: absolute;
            /* Permite centrar verticalmente */
            top: 0;
            /* Coloca la imagen en la parte superior */
            bottom: 0;
            /* Coloca la imagen en la parte inferior */
            left: 0;
            /* Coloca la imagen en la parte izquierda */
            right: 0;
            /* Coloca la imagen en la parte derecha */
        }
    </style>
</head>

<body>
    <!-- Header -->

    <header class="header">
        <div class="header_inner d-flex flex-row align-items-center justify-content-start">
            <div class="logo"><a class="navbar-brand ps-5" href="index.php"><img src="../assets/images/logo.png" alt="logo" height="90px"></a></div>
            <nav class="main_nav">
                <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="catalogo.php">Catalogo</a></li>
                    <li><a href="nosotros.php">Sobre Nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if (!empty($user) && $user['rol'] == 'admin') : ?> <!-- si hay usuario y es admin -->
                    <li><a href="resumen.php">Admin</a></li>
                <?php endif; ?>
                    <li><a href="#"></a></li>
                </ul>
            </nav>
            <div class="header_content ml-auto">

                <div class="shopping">
                    <!-- Cart -->
                    <a href="carrito.php">
                        <div class="cart">
                            <img src="../plantilla/images/shopping-bag.svg" alt="">
                            <div class="cart_num_container">
                                <div class="cart_num_inner">
                                    <div class="cart_num"><?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Avatar -->
                    <a href="../login.php">
                        <div class="avatar">
                            <img src="../plantilla/images/avatar.png" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <div class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>

    <!-- Menu -->

    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        <div class="menu_close_container">
            <div class="menu_close">
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="logo menu_mm"><a class="navbar-brand ps-5" href="index.php"><img src="assets/images/logo.png" alt="logo" height="100px"></a></div>
        <nav class="menu_nav">
            <ul class="menu_mm">
                <li class="menu_mm"><a href="../">Inicio</a></li>
                <li class="menu_mm"><a href="catalogo.php">Catalogo</a></li>
                <li class="menu_mm"><a href="nosotros.php">Sobre Nosotros</a></li>
                <li class="menu_mm"><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </div>

    <div class="super_container">


        <!-- Home -->

        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll" data-image-src="../assets/images/fondo5.png" data-speed="0.8"></div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_container">
                            <div class="home_content">
                                <div class="home_title">Productos</div>
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="../index.php">Inicio</a></li>
                                        <li>Muebles</li>
                                        <li>Solamente lo Mejor</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products -->

        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <!-- Sidebar Left -->

                        <div class="sidebar_left clearfix">

                            <!-- Categories -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Categorias</div>
                                <div class="sidebar_section_content">
                                    <ul>
                                        <li><a href="#">Salas (23)</a></li>
                                        <li><a href="#">Comedores (11)</a></li>
                                        <li><a href="#">Cocinas (61)</a></li>
                                        <li><a href="#">Recamaras (34)</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Color -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Color</div>
                                <div class="sidebar_section_content sidebar_color_content mCustomScrollbar" data-mcs-theme="minimal-dark">
                                    <ul>
                                        <li><a href="#"><span style="background:#a3ccff"></span>Azul (23)</a></li>
                                        <li><a href="#"><span style="background:#937c6f"></span>Caje (11)</a></li>
                                        <li><a href="#"><span style="background:#000000"></span>Negro (61)</a></li>
                                        <li><a href="#"><span style="background:#ff5c00"></span>Naranja (34)</a></li>
                                        <li><a href="#"><span style="background:#a3ffb2"></span>Verde (17)</a></li>
                                        <li><a href="#"><span style="background:#f52832"></span>Rojo (22)</a></li>
                                        <li><a href="#"><span style="background:#fdabf4"></span>Rosa (7)</a></li>
                                        <li><a href="#"><span style="background:#ecf863"></span>Amarillo (13)</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Size -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Tamaño</div>
                                <div class="sidebar_section_content">
                                    <ul>
                                        <li><a href="#">Pequello S (23)</a></li>
                                        <li><a href="#">Mediano M (11)</a></li>
                                        <li><a href="#">Grande L (61)</a></li>
                                        <li><a href="#">Extra Grande XL (34)</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Precio</div>
                                <div class="sidebar_section_content">
                                    <div class="filter_price">
                                        <div id="slider-range" class="slider_range"></div>
                                        <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                                        <div class="clear_price_btn">Eliminar Precio</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Best Sellers -->

                            <div class="sidebar_section">
                                <div class="sidebar_title">Best Sellers</div>
                                <div class="sidebar_section_content bestsellers_content">
                                    <ul>
                                        <!-- Best Seller Item -->
                                        <li class="clearfix">
                                            <div class="best_image"><img src="../plantilla/images/best_1.jpg" alt="">
                                            </div>
                                            <div class="best_content">
                                                <div class="best_title"><a href="product.html">Blue dress with dots</a>
                                                </div>
                                                <div class="best_price">$45</div>
                                            </div>
                                            <div class="best_buy">+</div>
                                        </li>

                                        <!-- Best Seller Item -->
                                        <li class="clearfix">
                                            <div class="best_image"><img src="../plantilla/images/best_2.jpg" alt="">
                                            </div>
                                            <div class="best_content">
                                                <div class="best_title"><a href="product.html">White t-shirt</a></div>
                                                <div class="best_price">$45</div>
                                            </div>
                                            <div class="best_buy">+</div>
                                        </li>

                                        <!-- Best Seller Item -->
                                        <li class="clearfix">
                                            <div class="best_image"><img src="../plantilla/images/best_3.jpg" alt="">
                                            </div>
                                            <div class="best_content">
                                                <div class="best_title"><a href="product.html">Blue dress with dots</a>
                                                </div>
                                                <div class="best_price">$45</div>
                                            </div>
                                            <div class="best_buy">+</div>
                                        </li>

                                        <!-- Best Seller Item -->
                                        <li class="clearfix">
                                            <div class="best_image"><img src="../plantilla/images/best_4.jpg" alt="">
                                            </div>
                                            <div class="best_content">
                                                <div class="best_title"><a href="product.html">White t-shirt</a></div>
                                                <div class="best_price">$45</div>
                                            </div>
                                            <div class="best_buy">+</div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <!-- Size -->
                            <div class="sidebar_section sidebar_options">
                                <div class="sidebar_section_content">

                                    <!-- Option Item -->
                                    <div class="sidebar_option d-flex flex-row align-items-center justify-content-start">
                                        <div class="option_image"><img src="../plantilla/images/option_1.png" alt="">
                                        </div>
                                        <div class="option_content">
                                            <div class="option_title">30 Days Returns</div>
                                            <div class="option_subtitle">No questions asked</div>
                                        </div>
                                    </div>

                                    <!-- Option Item -->
                                    <div class="sidebar_option d-flex flex-row align-items-center justify-content-start">
                                        <div class="option_image"><img src="../plantilla/images/option_2.png" alt="">
                                        </div>
                                        <div class="option_content">
                                            <div class="option_title">Free Delivery</div>
                                            <div class="option_subtitle">On all orders</div>
                                        </div>
                                    </div>

                                    <!-- Option Item -->
                                    <div class="sidebar_option d-flex flex-row align-items-center justify-content-start">
                                        <div class="option_image"><img src="../plantilla/images/option_3.png" alt="">
                                        </div>
                                        <div class="option_content">
                                            <div class="option_title">Secure Payments</div>
                                            <div class="option_subtitle">No need to worry</div>
                                        </div>
                                    </div>

                                    <!-- Option Item -->
                                    <div class="sidebar_option d-flex flex-row align-items-center justify-content-start">
                                        <div class="option_image"><img src="../plantilla/images/option_4.png" alt="">
                                        </div>
                                        <div class="option_content">
                                            <div class="option_title">24/7 Support</div>
                                            <div class="option_subtitle">Just call us</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="current_page">Muebles Disponibles</div>
                    </div>
                    <div class="col-12">
                        <div class="product_sorting clearfix">
                            <div class="view">
                                <div class="view_box box_view"><i class="fa fa-th-large" aria-hidden="true"></i></div>
                                <div class="view_box detail_view"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            </div>
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Mostrar Todos</span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Mostrar
                                                    Todos</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>
                                                <span>Precio</span>
                                            </li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "stars" }'>
                                                <span>Estrellas</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="sorting_text">Ver</span>
                                        <span class="num_sorting_text">12</span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="num_sorting_btn"><span>3</span></li>
                                            <li class="num_sorting_btn"><span>6</span></li>
                                            <li class="num_sorting_btn"><span>12</span></li>
                                            <li class="num_sorting_btn"><span>50</span></li>
                                            <li class="num_sorting_btn"><span>1000</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row products_container">
                    <div class="col">

                        <!-- Products -->

                        <div class="product_grid">
                            <?php
                            if ($products) {
                                foreach ($products as $product) {
                                    // Ajustar la ruta de la imagen
                                    $image_path = "../assets/images/uploads/" . $product['image'];

                                    echo "<div class='product'>";
                                    echo "<div class='product_image'><img src='" . $image_path . "' alt='" . $product['nombre_prod'] . "'></div>";
                                    echo "<div class='product_content clearfix'>";
                                    echo "<div class='product_info'>";
                                    // Enlace al detalle del producto
                                    echo "<div class='product_name'><h2><a href='producto.php?id=" . urlencode(openssl_encrypt($product['id_producto'], COD, KEY)) . "'>" . $product['nombre_prod'] . "</a></h2></div>";
                                    echo "<div class='product_price'>$" . $product['precio_prod'] . "</div>";
                                    echo "</div>"; // Cierre de product_info
                                    echo "<div class='product_options'>";
                                    echo "<div class='product_buy product_option'>";
                                    echo "<form class='add-to-cart-form' action='' method='POST'>";
                                    echo "<input type='hidden' name='id' value='" . openssl_encrypt($product['id_producto'], COD, KEY) . "'>";
                                    echo "<input type='hidden' name='image' value='" . openssl_encrypt($product['image'], COD, KEY) . "'>";
                                    echo "<input type='hidden' name='nombre' value='" . openssl_encrypt($product['nombre_prod'], COD, KEY) . "'>";
                                    echo "<input type='hidden' name='descripcion_prod' value='" . openssl_encrypt($product['descripcion_prod'], COD, KEY) . "'>";
                                    echo "<input type='hidden' name='precio' value='" . openssl_encrypt($product['precio_prod'], COD, KEY) . "'>";
                                    echo "<input type='hidden' name='cantidad' value='" . openssl_encrypt(1, COD, KEY) . "'>";
                                    echo "<button name='btn-accion' value='Agregar' type='submit'>";
                                    echo "<img src='../plantilla/images/shopping-bag-white.svg' alt='bag'>";
                                    echo "</button>";
                                    echo "</form>";
                                    echo "</div>"; // Cierre de product_buy
                                    #echo "<div class='product_fav product_option'>+</div>";
                                    echo "</div>"; // Cierre de product_options
                                    echo "</div>"; // Cierre de product_content
                                    echo "</div>"; // Cierre de product
                                }
                            } else {
                                echo "No hay productos disponibles.";
                            }
                            ?>
                        </div>





                        <div class="row page_num_container">
                            <div class="col text-right">
                                <ul class="page_nums">
                                    <li><a href="#">01</a></li>
                                    <li class="active"><a href="#">02</a></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#">04</a></li>
                                    <li><a href="#">05</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sidebar Right -->

            <div class="sidebar_right clearfix">

                <!-- Promo 1 -->
                <div class="sidebar_promo_1 sidebar_promo d-flex flex-column align-items-center justify-content-center">
                    <div class="sidebar_promo_image" style="background-image: url(../plantilla/images/sidebar_promo_1.jpg)"></div>
                    <div class="sidebar_promo_content text-center">
                        <div class="sidebar_promo_title">30%<span>off</span></div>
                        <div class="sidebar_promo_subtitle">On all shoes</div>
                        <div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
                    </div>
                </div>

                <!-- Promo 2 -->
                <div class="sidebar_promo_2 sidebar_promo">
                    <div class="sidebar_promo_image" style="background-image: url(../plantilla/images/sidebar_promo_2.jpg)"></div>
                    <div class="sidebar_promo_content text-center">
                        <div class="sidebar_promo_title">30%<span>off</span></div>
                        <div class="sidebar_promo_subtitle">On all shoes</div>
                        <div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Extra -->



        <!-- Newsletter -->

        <div class="newsletter">
            <div class="newsletter_content">
                <div class="newsletter_image" style="background-image:url(../plantilla/images/newsletter.jpg)">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section_title_container text-center">
                                <div class="section_subtitle">only the best</div>
                                <div class="section_title">subscribe for a 20% discount</div>
                            </div>
                        </div>
                    </div>
                    <div class="row newsletter_container">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="newsletter_form_container">
                                <form action="#">
                                    <input type="email" class="newsletter_input" required="required" placeholder="E-mail here">
                                    <button type="submit" class="newsletter_button">subscribe</button>
                                </form>
                            </div>
                            <div class="newsletter_text">Integer ut imperdiet erat. Quisque ultricies lectus
                                tellus, eu tristique magna pharetra nec. Fusce vel lorem libero. Integer ex mi,
                                facilisis sed nisi ut, vestib ulum ultrices nulla. Aliquam egestas tempor leo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="footer_logo"><a href="#">Wish</a></div>
                        <nav class="footer_nav">
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><a href="categories.html">clothes</a></li>
                                <li><a href="categories.html">accessories</a></li>
                                <li><a href="categories.html">lingerie</a></li>
                                <li><a href="contact.html">contact</a></li>
                            </ul>
                        </nav>
                        <div class="footer_social">
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="../plantilla/js/jquery-3.2.1.min.js"></script>
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