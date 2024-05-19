<?php 
#Incluimos la sesion de usuario y de carrito
include "controllers/user_session.php";

?>

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
    <link rel="stylesheet" href="assets/css/loader.css">


    
</head>

<body>
	<!--LOADER -->
	<div class="loader">
		<div class="loader-large"></div>
		<div class="loader-small"></div>
	</div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php
        include "pages/layouts/index2.php";
    ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="content-wrapper">

                


<!-- Home -->

<div class="home">
		
		<!-- Home Slider -->

		<div class="home_slider_container">

        
            
			<div class="owl-carousel owl-theme home_slider">
                
				
				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" 
					style="background-image:url(assets/images/productos/salaprincipal.jpg)"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Descansa en estilo, vive con comodidad</div>
							<div class="home_slider_title">Muebleria Alvarez</div>
						</div>	
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" 
					style="background-image:url(assets/images/productos/comedorprincipal.png)"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Solamente lo Mejor</div>
							<div class="home_slider_title">Muebleria Alvarez</div>
						</div>	
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" 
					style="background-image:url(assets/images/productos/cocinaprincipal.png)"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Lleva todo para tu hogar</div>
							<div class="home_slider_title">Muebleria Alvarez</div>
						</div>	
					</div>
				</div>


                <!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" 
					style="background-image:url(assets/images/fondo3.png)"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Descansa en estilo, vive con comodidad</div>
							<div class="home_slider_title">Muebleria Alvarez</div>
						</div>	
					</div>
				</div>

                <!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" 
					style="background-image:url(assets/images/fondo1.png)"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Solamente lo Mejor</div>
							<div class="home_slider_title">Muebleria Alvarez</div>
						</div>	
					</div>
				</div>
			</div>
			
			<!-- Home Slider Nav -->

			<!-- <div class="home_slider_next d-flex flex-column align-items-center justify-content-center"><img src="plantilla/images/arrow_r.png" alt=""></div> -->

			<!-- Home Slider Dots -->

			<div class="home_slider_dots_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
									<li class="home_slider_custom_dot active">01.<div></div></li>
									<li class="home_slider_custom_dot">02.<div></div></li>
									<li class="home_slider_custom_dot">03.<div></div></li>
                                    <li class="home_slider_custom_dot">04.<div></div></li>
                                    <li class="home_slider_custom_dot">05.<div></div></li>
								</ul>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>

	<!-- Promo -->

	<div class="promo">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">descansa en estilo, vive con comodidad</div>
						<div class="section_title">Productos en Promoción</div>
					</div>
				</div>
			</div>
			<div class="row promo_container">

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="assets/images/productos/salaprincipal.jpg" alt="">
							<div class="promo_content promo_content_2">
								<div class="promo_title">-30% descuento</div>
								<div class="promo_subtitle">En todas las salas</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="assets/images/productos/comedorprincipal.png" alt="">
							<div class="promo_content promo_content_2">
								<div class="promo_title">-40% descuento</div>
								<div class="promo_subtitle">en todos los comedores</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="assets/images/productos/cocinaprincipal.png" alt="">
							<div class="promo_content promo_content_2">
								<div class="promo_title">-10% descuento</div>
								<div class="promo_subtitle">en todas las cocinas completas</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- New Arrivals -->
<div class="arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <div class="section_subtitle">Solamente lo Mejor</div>
                    <div class="section_title">Nuevos Productos</div>
                </div>
            </div>
        </div>
        <div class="row products_container">

		<?php include 'pages/productos.php'; ?>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col-lg-4 product_col">
                        <div class="product">
                            <div class="product_image">
                                <img src="<?php echo $producto['image']; ?>" alt="<?php echo $producto['nombre']; ?>">
                            </div>
                            <div class="rating rating_4">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product_content clearfix">
                                <div class="product_info">
                                    <div class="product_name"><a href="product.html"><?php echo $producto['nombre']; ?></a></div>
                                    <div class="product_price">$<?php echo number_format($producto['precio'], 2); ?></div>
                                </div>
                                <div class="product_options">
                                    <div class="product_buy product_option"><img src="plantilla/images/shopping-bag-white.svg" alt="Comprar"></div>
                                    <div class="product_fav product_option">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

	
	<!-- Extra -->

	<div class="extra clearfix">
		<div class="extra_promo extra_promo_1">
			<div class="extra_promo_image" style="background-image:url(plantilla/images/extra_1.jpg)"></div>
			<div class="extra_1_content d-flex flex-column align-items-center justify-content-center text-center">
				<div class="extra_1_price">30%<span>de Descuento</span></div>
				<div class="extra_1_title">En Todas las Primeras Compras del dia</div>
				<div class="extra_1_text">*Aplica Restricciones.</div>
				<div class="button extra_1_button"><a href="checkout.html">Ir</a></div>
			</div>
		</div>
		<div class="extra_promo extra_promo_2">
			<div class="extra_promo_image" style="background-image:url(plantilla/images/extra_2.jpg)"></div>
			<div class="extra_2_content d-flex flex-column align-items-center justify-content-center text-center">
				<div class="extra_2_title">
					<div class="extra_2_center">&</div>
					<div class="extra_2_top">Uno</div>
					<div class="extra_2_bottom">Dos</div>
				</div>
				<div class="extra_2_text">*Aplica Restricciones.</div>
				<div class="button extra_2_button"><a href="checkout.html">Ir</a></div>
			</div>
		</div>
	</div>

            </div>

        </div>

<br>
        <?php
        include "pages/layouts/footer.php"
  ?>


        <script>
			function CargarContenido(pagina_php, contenedor) {
				$("." + contenedor).load(pagina_php);
			}

        </script>
		<script src="assets/js/loader.js"></script>
        
</body>

</html>
