<?php
// traemos la sesion de usuario y carrito
include "../controllers/user_session.php";
include "../controllers/carrito.php";

// Filtros
$whereClauses = [];
$parameters = [];

// Filtro de categorías
if (isset($_GET['categoria'])) {
    $categorias = $_GET['categoria'];
    $placeholders = rtrim(str_repeat('?,', count($categorias)), ',');
    $whereClauses[] = "categoria IN ($placeholders)";
    $parameters = array_merge($parameters, $categorias);
}

// Filtro de departamentos
if (isset($_GET['departamento'])) {
    $departamento_id = $_GET['departamento'];
    $whereClauses[] = "id_departamento = ?";
    $parameters[] = $departamento_id;
}

// Filtro de colores
if (isset($_GET['color'])) {
    $color = $_GET['color'];
    $whereClauses[] = "id_color = ?";
    $parameters[] = $color;
}

// Filtro de materiales
if (isset($_GET['material'])) {
    $material = $_GET['material'];
    $whereClauses[] = "id_material = ?";
    $parameters[] = $material;
}

// Filtro de tapices
if (isset($_GET['tapiz'])) {
    $tapiz = $_GET['tapiz'];
    $whereClauses[] = "id_tapiz = ?";
    $parameters[] = $tapiz;
}

// Filtro de stock
$whereClauses[] = "stock_prod > 0";

// Construcción de la cláusula WHERE
$whereSql = "";
if (count($whereClauses) > 0) {
    $whereSql = "WHERE " . implode(" AND ", $whereClauses);
}

// Obtener los productos de la base de datos 
$sql = "SELECT * FROM productos $whereSql";
$statement = $conn->prepare($sql);
$statement->execute($parameters);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// Obtener los departamentos de la base de datos
$sqlDepartamentos = "SELECT * FROM departamentos";
$statementDepartamentos = $conn->prepare($sqlDepartamentos);
$statementDepartamentos->execute();
$departamentos = $statementDepartamentos->fetchAll(PDO::FETCH_ASSOC);

// Obtener los colores de la base de datos
$sqlColores = "SELECT * FROM color";
$statementColores = $conn->prepare($sqlColores);
$statementColores->execute();
$colores = $statementColores->fetchAll(PDO::FETCH_ASSOC);

// Obtener los materiales de la base de datos
$sqlMateriales = "SELECT * FROM material";
$statementMateriales = $conn->prepare($sqlMateriales);
$statementMateriales->execute();
$materiales = $statementMateriales->fetchAll(PDO::FETCH_ASSOC);

// Obtener los tapices de la base de datos
$sqlTapices = "SELECT * FROM tapiz";
$statementTapices = $conn->prepare($sqlTapices);
$statementTapices->execute();
$tapices = $statementTapices->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="../plantilla/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/styles/categories_responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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


    /* Estilo para que el botón ocupe todo el ancho */
    .sidebar_section .btn-block {
        width: 100%;
    }

    /* Estilo para que el botón sea de color #625FCF */
    .custom-btn {
        background-color: #7571F9;
        border-color: #7571F9;
    }

    .custom-btn:hover {
        background-color: #4e4dc1;
        border-color: #4e4dc1;
    }
    </style>

<style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .avatar a {
            text-decoration: none;
            color: inherit;
        }

        .avatar span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header -->

    <header class="header">
        <div class="header_inner d-flex flex-row align-items-center justify-content-start">
            <div class="logo"><a class="navbar-brand ps-5" href="index.php"><img src="../assets/images/logo.png"
                        alt="logo" height="90px"></a></div>
            <nav class="main_nav">
                <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="catalogo.php">Catalogo</a></li>
                    <li><a href="aboutus.php">Sobre Nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if (!empty($user) && $user['rol'] == 'admin') : ?>
                    <!-- si hay usuario y es admin -->
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
                                    <div class="cart_num">
                                        <?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <?php if (!empty($user)) : ?>
                        
                    <!-- Dropdown Menu -->
                    <div class="dropdown">
                            <div class="avatar">
                            <?php if (!empty($user) && $user['rol'] == 'admin') : ?>
                            <a href="resumen.php" class="avatar">
                    <?php endif; ?>
                                <img src="../plantilla/images/avatar.png" alt="">
                                <span><?= $user['nom_usuario']; ?></span>  
                                <?php if (!empty($user) && $user['rol'] == 'admin') : ?>
                                </a>
                    <?php endif; ?>
                            </div>
                            <div class="dropdown-content">
                                <a href="../controllers/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                            </div>
                        </div>

                    <?php else : ?>
                    <!-- Avatar -->
                    <a href="../login.php">
                        <div class="avatar">
                            <img src="../plantilla/images/avatar.png" alt="">
                        </div>
                    </a>
                </div>
            </div>
            <?php endif; ?>
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

    <div class="super_container">


        <!-- Home -->

        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll"
                data-image-src="../assets/images/fondo5.png" data-speed="0.8"></div>
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
                            <!-- Botón para borrar filtros -->
                            <div class="sidebar_section">
                                <button id="clear-filters-btn" class="btn btn-primary btn-block custom-btn">Borrar
                                    filtros</button>
                            </div>

                            <!-- Categorias -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Departamentos</div>
                                <div class="sidebar_section_content sidebar_color_content mCustomScrollbar"
                                    data-mcs-theme="minimal-dark">
                                    <ul>
                                        <?php foreach ($departamentos as $departamento): ?>
                                        <li><a href="#" class="filter-link" data-filter="departamento"
                                                data-value="<?= $departamento['id_departamento'] ?>"><?= $departamento['departamento_nom'] ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Color -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Color</div>
                                <div class="sidebar_section_content sidebar_color_content mCustomScrollbar"
                                    data-mcs-theme="minimal-dark">
                                    <ul>
                                        <?php foreach ($colores as $color): ?>
                                        <li><a href="#" class="filter-link" data-filter="color"
                                                data-value="<?= $color['id_color'] ?>"><span
                                                    style="background:<?= $color['colorHex'] ?>"></span><?= $color['color_nom'] ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Material -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Material</div>
                                <div class="sidebar_section_content sidebar_color_content mCustomScrollbar"
                                    data-mcs-theme="minimal-dark">
                                    <ul>
                                        <?php foreach ($materiales as $material): ?>
                                        <li><a href="#" class="filter-link" data-filter="material"
                                                data-value="<?= $material['id_material'] ?>"><?= $material['material_nom'] ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Tapiz -->
                            <div class="sidebar_section">
                                <div class="sidebar_title">Tapiz</div>
                                <div class="sidebar_section_content sidebar_color_content mCustomScrollbar"
                                    data-mcs-theme="minimal-dark">
                                    <ul>
                                        <?php foreach ($tapices as $tapiz): ?>
                                        <li><a href="#" class="filter-link" data-filter="tapiz"
                                                data-value="<?= $tapiz['id_tapiz'] ?>"><?= $tapiz['tapiz_nom'] ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="current_page">Muebles Disponibles</div>
                    </div>
                    <div class="col-12">
                        <div class="product_sorting clearfix">

                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Mostrar Todos</span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn"
                                                data-isotope-option='{ "sortBy": "original-order" }'><span>Mostrar
                                                    Todos</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>
                                                <span>Precio</span>
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


                    </div>
                </div>
            </div>

            <!-- Sidebar Right -->

            <div class="sidebar_right clearfix">
                

                <!-- Promo 1 -->
                <div class="sidebar_promo_1 sidebar_promo d-flex flex-column align-items-center justify-content-center">
                    <div class="sidebar_promo_image"
                        style="background-image: url(../assets/images/productos/salaprincipal.jpg)"></div>
                    <div class="sidebar_promo_content text-center">
                        <div class="sidebar_promo_title">-30% <span>descuento</span></div>
                        <div class="sidebar_promo_subtitle">En todas las salas</div>
                        <div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
                    </div>
                </div><br>

                
                <!-- Promo 3 -->
                <div class="sidebar_promo_1 sidebar_promo d-flex flex-column align-items-center justify-content-center">
                    <div class="sidebar_promo_image"
                        style="background-image: url(../assets/images/productos/comedorprincipal.png)"></div>
                    <div class="sidebar_promo_content text-center">
                        <div class="sidebar_promo_title">-10% <span>descuento</span></div>
                        <div class="sidebar_promo_subtitle">En todas las cocinas completas</div>
                        <div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
                    </div>
                </div>

            </div>

        </div>

        
	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_content">
			<div class="newsletter_image" style="background-image:url(../assets/images/fondo4.png)"></div>
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title_container text-center">
							<div class="section_subtitle">Descansa en estilo, vive con comodidad</div>
							<div class="section_title">Disfruta de todas nuestras Promociones</div>
						</div>
					</div>
				</div>
				<div class="row newsletter_container">
					<div class="col-lg-10 offset-lg-1">
						<div class="newsletter_form_container">
						
						</div>
						<div class="newsletter_text">Solo por tiempo limitado  y sujeto a disponibilidad</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php
        include "layouts/footer2.php"
  		?>



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


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterLinks = document.querySelectorAll('.filter-link');
        filterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const filterType = this.getAttribute('data-filter');
                const filterValue = this.getAttribute('data-value');

                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set(filterType, filterValue);

                window.location.search = urlParams.toString();
            });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const clearFiltersButton = document.getElementById('clear-filters-btn');
        clearFiltersButton.addEventListener('click', function() {
            window.location.href =
            'catalogo.php'; // Redirigir a la página de catálogo sin ningún filtro
        });
    });
    </script>
</body>

</html>