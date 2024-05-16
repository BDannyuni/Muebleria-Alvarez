


<!doctype html>
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
    


    
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php
        include "pages/layouts/index2.php";
    ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="content-wrapper">

                <?php include "pages/principal.php" ?>

            </div>

        </div>

<br>
        <?php
        include "layouts/footer.php"
  ?>


        <script>
        function CargarContenido(pagina_php, contenedor) {
            $("." + contenedor).load(pagina_php);
        }
        </script>
        
</body>

</html>
