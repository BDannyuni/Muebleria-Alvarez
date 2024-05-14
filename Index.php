<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muebleria Alvarez</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assest/js/login.js">
</head>

<body>
    
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="login/registrar.usuarios.php" method="post">
        <h1>Registrarse</h1><br>
                        
                            <input type="text" placeholder="Nombre Completo" class="form-control" name="nombre_completo_usuario" id="nombre_completo_usuario">
                       
                       
                            <input type="text" placeholder="Correo Electronico" class="form-control" name="correo_usuario" id="correo_usuario">
                      
                        
                            <input type="text" placeholder="Nombre de Usuario" class="form-control" name="usuario" id="usuario">
                       
                       
                            <input type="password" placeholder="Contraseña" class="form-control" name="contra_usuario" id="contra_usuario">
                      
                            <select name="tipo_usuario" class="select-css" id="tipo_usuario">
                                <option value="0">Selecione el Tipo de Usuario</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                        

                        <div class="card-tools offset-lg-2" style="display: inline">
                            <input class='btn btn-success' type="submit" name="registrar_usuario"
                                value="Registrar Usuario">
                        </div>
                    </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="post" action="#">
            <h1>Iniciar Sesion</h1>
            <div class="social-container">
            </div>
            <input type="text" placeholder="Nombre de Usuario" name="Usuario" />
            <input type="password" placeholder="Contraseña" name="Contraseña"/>
            <a href="#">¿olvidaste tu contraseña?</a>
            <input type="submit" name="btningresar" value="INICIAR SESION" class="btn"/>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bienvenido por primera vez!!</h1><br>
                <img src="assets/images/Icono.png" height="120px" alt=""><h3>Muebleria Alvarez</h3><br>
                <button class="ghost" id="signIn">Iniciar Sesion</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Bienvenido de Vuelta!!</h1><br>
                <img src="assets/images/Icono.png" height="120px"  alt=""><h3>Muebleria Alvarez</h3><br>
                <button class="ghost" id="signUp">Crear cuenta</button>
            </div>
        </div>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    
<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>

</body>

</html>