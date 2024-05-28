<!-- Footer -->

<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="footer_logo"> <a class="navbar-brand ps-5"  href="index.php"><img src="assets/images/logo.png" alt="logo"></a></div>
					<nav class="footer_nav">
						<ul>
						<li><a href="index.php">Inicio</a></li>
                        <li><a href="pages/catalogo.php">Catalogo</a></li>
                        <li><a href="pages/nosotros.php">Sobre Nosotros</a></li>
                        <li><a href="pages/contacto.php">Contacto</a></li>
						<?php if (!empty($user) && $user['rol'] == 'admin') : ?> <!-- si hay usuario y es admin -->
                    <li><a href="pages/resumen.php">Admin</a></li>
                <?php endif; ?>
						</ul>
					</nav>
					
					<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos Los Derechos Reservados | Esta Pagina esta Hecha solo para fin educativo <br> Hecho por <a href="https://colorlib.com" target="_blank">Brandon</a> y <a href="https://colorlib.com" target="_blank">Maximo</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
				</div>
			</div>
		</div>
	</footer>
</div>
