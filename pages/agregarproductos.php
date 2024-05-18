
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plantilla/quixlab-master/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">

</head>

<body>
<!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
        <div class="brand-logo">
                <a href="../index.php">
                    <b class="logo-abbr"><img src="../assets/images/logo-blanco.png" alt=""> </b>
                    <span class="logo-compact"><img src="../assets/images/logo-blanco.png" alt=""></span>
                    <span class="brand-title text-white mt-2">
                        <img src="../assets/images/logo-blanco.png" height="32px" style="margin-right:5px;" alt="">Muebleria Alvarez
                    </span>
                </a>
            </div>
    
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"> <li><a href="../index.php">Inicio</a></li></span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"> <li><a href="catalogo.php">Catalogo</a></li></span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"> <li><a href="nosotros.php">Sobre Nosotros</a></li></span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"> <li><a href="contacto.php.php">Contacto</a></li></span>
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"> <li><a href="resumen.php">Admin</a></li></span>
                        </div>
                        
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../plantilla/quixlab-master/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill badge-primary">3</div></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="resumen.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Resumen</span>
                        </a>
                        
                    </li></li>
                    <li class="nav-label">Inventario</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="Listadoproductos.php" aria-expanded="false">
                        <i class="ti-layout"></i><span class="nav-text">Productos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="agregarproductos.php" aria-expanded="false">
                        <i class="icon-note menu-icon"></i><span class="nav-text">Agregar Productos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#.php" aria-expanded="false">
                        <i class="ti-bag"></i><span class="nav-text">Departamentos</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#.php" aria-expanded="false">
                        <i class="ti-layers"></i><span class="nav-text">Categorias</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#.php" aria-expanded="false">
                        <i class="ti-layers"></i><span class="nav-text">Productos con Poco Stock</span>
                        </a>
                    </li></li>
                    <li class="nav-label">Venta</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                        <i class="ti-shopping-cart"></i><span class="nav-text">Ventas</span>
                        </a>
                    </li>
                    <li class="nav-label">Extra</li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                        <i class="ti-user"></i><span class="nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="#" aria-expanded="false">
                        <i class="ti-clipboard"></i><span class="nav-text">Admin Usuarios</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
            <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre del producto:</label>
        <input type="text" name="name" id="name" required><br><br>
        <label for="description">Codigo:</label>
        <textarea name="description" id="description" required></textarea><br><br>
        <label for="price">Precio:</label>
        <input type="text" name="price" id="price" required><br><br>
        <label for="image">Imagen:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>
        <input type="submit" name="submit" value="Subir Producto">
    </form>

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>

</body>
