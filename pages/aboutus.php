<?php
#Incluimos la sesion de usuario y de carrito
include "../controllers/user_session.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Sobre Nosotros</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../assets/css/loader.css">
    <style>
        .row.single-form {
            box-shadow: 0 2px 20px 0 rgba(0,0,0,0.5);
        }
        .about-us {
            margin-top: 150px;
        }
        .about-us img {
            width: 100%;
            height: auto;
            display: block;
        }
        .about-us .description {
            padding-left: 30px;
            color: #000;
        }
        .about-us .names {
            text-align: center;
            margin-top: 30px;
            color: #000;
        }
        .about-us .names p {
            margin: 5px 0;
        }
        .name {
            color: #000;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "layouts/headerIN.php"; ?>

    <div class="super_container">
        <!--LOADER -->
        <div class="loader">
            <div class="loader-large"></div>
            <div class="loader-small"></div>
        </div>

        <!--CONTENT -->
        <div class="about-us">
            <div class="container">
                <h2 class="text-center">Sobre Nosotros</h2>
                <div class="row single-form g-0">
                    <div class="col-sm-12 col-lg-6">
                        <img src="../assets/images/familia.jpg" alt="Sobre Nosotros">
                    </div>
                    <div class="col-sm-12 col-lg-6 description">
                        <p class="name">
                            En Mueblería Álvarez, entendemos que la comodidad es esencial para el bienestar en el hogar. Desde nuestros inicios, nos hemos comprometido a proporcionar muebles que no solo embellecen tus espacios, sino que también ofrecen el máximo confort. Cada pieza que diseñamos y fabricamos está pensada para que disfrutes de momentos de relajación y descanso en tu hogar. Nuestro catálogo incluye una amplia variedad de muebles ergonómicos y de alta calidad, desde sofás y sillones hasta camas y sillas, todos ellos creados con materiales seleccionados que garantizan durabilidad y una experiencia de uso excepcional. En Mueblería Álvarez, tu comodidad es nuestra prioridad.
                        </p>
                    </div>
                </div>
                <div class="names">
                    <h3>Agradecimientos</h3>
                    <p class="name">Juan Carlos Ríos solis </p>
                    <p class="name">Angela Sofía Leal Sandoval </p>
                    <p class="name">Julio Escamilla Venegas </p>
                    <p class="name">Brandon Daniel Alvarez Hernandez </p>
                    <p class="name">Máximo Gonzalez Nancianceno </p>
                </div>
            </div>
        </div>
    
        <?php include "layouts/footer2.php"; ?>                       
        
    </div>
    <script src="../assets/js/loader.js"></script>
    
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
