<?php
#Incluimos la sesion de usuario y de carrito
include "../controllers/user_session.php";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../assets/css/loader.css">
    <style>
        .row.single-form {
            box-shadow: 0 2px 20px 0 rgba(0,0,0,0.5);
        }
        .left {
            background: blueviolet;
            padding: 150px 98px;
        }
        .left h2 {
            color: #fff;
            font-weight: 700;
            font-size: 48px;
        }
        .left h2 span {
            font-weight: 100;
        }
        .single-form{
            background: #fff;
        }
        .right {
            padding: 70px 100px;
            position: relative;
        }
        .right i {
            position: absolute;
            font-size: 80px;
            left: -27px;
            top: 40%;
            color: #fff;
        }
        .form-control {
            border: 2px solid #000;
        }
        .right button {
            border: none;
            border-radius: 0;
            background: #252525;
            width: 180px;
            color: #fff;
            padding: 15px 0;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }
        .right button:hover{
            background-color: #252525;
        }


        /*responsive*/

        @media (min-width:768px) and (max-width:991px){
            .right i {
                top: -52px;
                transform: rotate(90deg);
                left: 50%;
            }
        }

        @media (max-width:767px){
            .left {
                padding: 90px 15px;
                text-align: center;
            }
            .left h2 {
                font-size: 25px;
            }
            .right {
                padding: 25px;
            }
            .right i {
                top: -52px;
                transform: rotate(90deg);
                left: 46%;
            }
            .right button {
                width: 150px;
                padding: 12px 0;
            }
                
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
        <div class="form-area " style="margin-top: 150px;">
            <div class="container">
                <div class="row single-form g-0">
                    <div class="col-sm-12 col-lg-6">
                        <div class="left">
                            <h2><span>Contáctanos,</span><br>Nos encantaría escuchar tu opinión.</h2>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="right">
                            <i class="fa fa-caret-left"></i>
                            <form  action="https://formspree.io/f/xkndaywz" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tu nombre</label>
                                    <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Tu opinion</label>
                                    <textarea class="form-control" name="opinion"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php include "layouts/footer2.php"; ?>                       
        
    </div>
    <script src="../assets/js/loader.js"></script>
    <script>
        // SCRIPT PARA MANEJAR EL ENVIO DEL FORMULARIO
        const form = document.querySelector("form");
        form.addEventListener("submit", handleSubmit);

        async function handleSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            try {
                const response = await fetch(event.target.action, {
                    method: event.target.method,
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    event.target.reset();
                    Swal.fire({
                        title: "¡Buen trabajo!",
                        text: "Tu mensaje ha sido enviado.",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Oops...",
                        text: "Hubo un problema al enviar tu mensaje. Intenta nuevamente.",
                        icon: "error"
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "Oops...",
                    text: "Hubo un problema al enviar tu mensaje. Intenta nuevamente.",
                    icon: "error"
                });
            }
        }
    </script>
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