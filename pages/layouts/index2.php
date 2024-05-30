<!DOCTYPE html>
<html lang="es">

<head>
    <title>Muebleria Alvarez</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Wish shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="plantilla/styles/bootstrap4/bootstrap.min.css">
    <link href="plantilla/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plantilla/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plantilla/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plantilla/plugins/OwlCarousel2-2.2.1/animate.css">
    <link href="plantilla/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plantilla/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="plantilla/styles/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

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

    <div class="super_container">

        <!-- Header -->

        <header class="header">
            <div class="header_inner d-flex flex-row align-items-center justify-content-start">
                <div class="logo"><a class="navbar-brand ps-5" href="index.php"><img src="assets/images/logo.png"
                            alt="logo" height="90px"></a></div>
                <nav class="main_nav">
                    <ul>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="pages/catalogo.php">Catalogo</a></li>
                        <li><a href="pages/aboutus.php">Sobre Nosotros</a></li>
                        <li><a href="pages/contacto.php">Contacto</a></li>
                        <?php if (!empty($user) && $user['rol'] == 'admin') : ?> <!-- si hay usuario y es admin -->
                    <li><a href="pages/resumen.php">Admin</a></li>
                <?php endif; ?>
                        
                    </ul>
                </nav>
                <div class="header_content ml-auto">
                    <div class="shopping">
                        <!-- Cart -->
                        <a href="pages/carrito.php">
                            <div class="cart">
                                <img src="plantilla/images/shopping-bag.svg" alt="">
                                <div class="cart_num_container">
                                    <div class="cart_num_inner">
                                        <div class="cart_num"><?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php if (!empty($user)) : ?>

                         <!-- Dropdown Menu -->
                         <div class="dropdown">
                            <div class="avatar">
                            <a href="pages/resumen.php" class="avatar">
                                <img src="plantilla/images/avatar.png" alt="">
                                <span><?= $user['nom_usuario']; ?></span>  
                            </a>
                            </div>
                            <div class="dropdown-content">
                                <a href="controllers/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                            </div>
                        </div>

                    <?php else : ?>
                         <!-- Avatar -->
                        <a href="login.php">
                            <div class="avatar">
                                <img src="plantilla/images/avatar.png" alt="">
                            </div>
                        </a>
                    </div>
                </div>
                    <?php endif; ?>
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
            <div class="logo menu_mm"><a class="navbar-brand ps-5" href="index.php"><img src="assets/images/logo.png"
                        alt="logo" height="100px"></a></div>
            <nav class="menu_nav">
                <ul class="menu_mm">
                    <li class="menu_mm"><a href="index.php">Inicio</a></li>
                    <li class="menu_mm"><a href="pages/catalogo.php">Catalogo</a></li>
                    <li class="menu_mm"><a href="nosotros.php">Sobre Nosotros</a></li>
                    <li class="menu_mm"><a href="pages/contacto.php">Contacto</a></li>
                <?php if (!empty($user) && $user['rol'] == 'admin') : ?> <!-- si hay usuario y es admin -->
                    <li><a href="pages/resumen.php">Admin</a></li>
                <?php endif; ?>

                </ul>
            </nav>
        </div>


		        	
<script src="plantilla/js/jquery-3.2.1.min.js"></script>
<script src="plantilla/styles/bootstrap4/popper.js"></script>
<script src="plantilla/styles/bootstrap4/bootstrap.min.js"></script>
<script src="plantilla/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plantilla/plugins/easing/easing.js"></script>
<script src="plantilla/plugins/parallax-js-master/parallax.min.js"></script>
<script src="plantilla/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="plantilla/js/custom.js"></script>

</body>

</html>