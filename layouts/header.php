<!DOCTYPE html>
<html lang="en">
<head>
    <title>Muebleria Alvarez</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Wish shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <style>
        .nav-item:hover,
        .nav-item.active {
            background-color: #635FCC;
            border-radius: 5px;
            font-weight: bold;
            transition: .2s ease;
        }
    </style>
	<!-- Header -->
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #AEB8CC;">
       <button 
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
        class="navbar-toggler"
        aria-controls="navbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
       >
            <span class="navbar-toogler-icon"></span>
       </button>
        <div class="collapse navbar-collapse" id="navbar" >
            <a class="navbar-brand ps-5"  href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 rounded d-flex p-4 justify-content-between w-100" style="background-color: #727070;">
                <div class="d-flex justify-content-start flex-grow-1">
                    <li class="nav-item active">
                        <a class="nav-link fs-4 text-white" href="#index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4 text-white" href="#">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4 text-white" href="#">Sobre Nosotros</a>
                    </li>
                </div>
                <div class="d-flex justify-content-end pe-5">
                    <li class="nav-item">
                        <a class="nav-link fs-3 text-white" href="login.php"><i class="bi bi-person-fill">Mi cuenta</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-3 text-white" href="carrito.php"><i class="bi bi-cart-fill">Carrito</i></a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
	
    <script>
        // selecciona todos los elementos de navegación
        var navItems = document.querySelectorAll('.nav-item');

        // Lrecorre cada elemento de navegación
        for (var i = 0; i < navItems.length; i++) {
            
            navItems[i].addEventListener('click', function() {
                // Cuando se hace click en un elemento, primero quita la clase 'active' de todos los elementos
                for (var j = 0; j < navItems.length; j++) {
                    navItems[j].classList.remove('active');
                }
                // Luego, agrega la clase 'active' al elemento que fue clickeado
                this.classList.add('active');
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
