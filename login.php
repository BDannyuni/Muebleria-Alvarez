<?php 
require_once 'controllers/user_session.php';

$message= '';

#REGISTRO DE USUARIOS
if (!empty($_POST['nombre_completo']) && !empty($_POST['email']) && !empty($_POST['nom_usuario']) && !empty($_POST['password'])){
    // Sanitizar los inputs
    $nombre_completo = filter_var($_POST['nombre_completo'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $nom_usuario = filter_var($_POST['nom_usuario'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO usuarios(nombre_completo, email,nom_usuario, password) VALUES (:nombre ,:email, :nom_usuario, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nombre", $nombre_completo);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":nom_usuario", $nom_usuario);
        /* HASHEAR PASSWORD */
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $password_hashed);
         #  EXECUTE
        if($stmt->execute()){
            $message = 'Se ha registrado exitosamente.';
            header('Location: index.php');
        }else {
            $message = 'Ha ocurrido un error, no se completo su registro';
        }
       
    } catch (Exception $e ) {
         // Handle the error if the email is a duplicate
         if ($e->getCode() == 23000) {
            // Display an error message
            $message = 'El correo ingresado ya se encuentra en uso';
        } else {
            // Handle other errors
            echo "Error: " . $e->getMessage();
        }
        
    }
}

#LOGIN DE USUARIOS
if(!empty($_POST['nom_usuario']) && !empty($_POST['password'])){
    $records = $conn->prepare('SELECT id_usuario, nom_usuario, password FROM usuarios WHERE nom_usuario=:nom_usuario');
    $nom_usuario = filter_var($_POST['nom_usuario'], FILTER_SANITIZE_SPECIAL_CHARS); // Sanitizar el input
    $records->bindParam(':nom_usuario', $nom_usuario);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if(is_countable($results) && count($results) >0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id_usuario'];
        /*REDIRECCIONAR*/
        if(!empty($_SESSION['user_id'])){
            //redireccion en caso de ser admin
            $query = "SELECT rol FROM usuarios WHERE nom_usuario=:nom_usuario";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":nom_usuario", $_POST['nom_usuario']);
            $stmt->execute();
            // Fetch the result row as an associative array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // REGRESA EL ROL DEL USUARIO
            $role = $row['rol'];
            if($role == 'admin' || $role == 'Admin' || $role == 'ADMIN' || $role == 'ADmin' || $role == 'ADMin' || $role == 'ADMIn'){
                // ES ADMIN
                header('Location: pages/resumen.php');
            }else{
                //No es admin
                header('Location: index.php');
            }
        }else{
            //EL USUARIO NO ESTA REGISTRADO O LOGEADO
            $message = 'No se ha podido iniciar sesion';
        }
    }else{
        $message = 'Los datos ingresados no son correctos.';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muebleria Alvarez</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/login.css">
    <!--<link rel="stylesheet" href="assest/js/login.js"> -->
    <link rel="stylesheet" href="assets/css/loader.css">
</head>

<body>
    <!--LOADER -->
    <div class="loader">
        <div class="loader-large"></div>
        <div class="loader-small"></div>
    </div>
    
    <!-- MENSAJE DE ERROR-->
    <?php if (!empty($message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $message ?> <!-- mensaje -->
        </div>
    <?php endif ?>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form  method="post">
        <h1>Registrarse</h1><br>
                        
                            <input type="text" placeholder="Nombre Completo" class="form-control" name="nombre_completo" value="<?php echo isset($_POST["nombre_completo"]) ? $_POST["nombre_completo"] : ''; ?>" required id="nombre_completo_usuario">
                       
                       
                            <input type="text" placeholder="Correo Electronico" class="form-control" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required id="correo_usuario">
                      
                        
                            <input type="text" placeholder="Nombre de Usuario" class="form-control" name="nom_usuario" value="<?php echo isset($_POST["nom_usuario"]) ? $_POST["nom_usuario"] : ''; ?>" required id="usuario">
                       
                       
                            <input type="password" placeholder="Contraseña" class="form-control"  name="password"  value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" required id="contra_usuario">
                      
                        

                        <div class="card-tools" style="display: inline">
                            <input class='btn btn-success' type="submit" name="registrar_usuario"
                                value="Registrar Usuario">
            <button><a class="text-white" href="index.php">Regresar</a></button>
                        </div>
                    </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="post">
            <h1>Iniciar Sesion</h1>
            <div class="social-container">
            </div>
            <input type="text" placeholder="Nombre de Usuario" name="nom_usuario"  value="<?php echo isset($_POST["nom_usuario"]) ? $_POST["nom_usuario"] : ''; ?>" required />
            <input type="password" placeholder="Contraseña" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" required"/>
            <a href="#">¿olvidaste tu contraseña?</a>
            <input type="submit" name="btningresar" value="INICIAR SESION" class="btn"/>
            <button><a class="text-white" href="index.php">Regresar</a></button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bienvenido por primera vez!!</h1><br>
                <img src="assets/images/logo2.png" height="120px" alt=""><h3>Muebleria Alvarez</h3><br>
                <button class="ghost" id="signIn">Iniciar Sesion</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Bienvenido de Vuelta!!</h1><br>
                <img src="assets/images/logo2.png" height="120px"  alt=""><h3>Muebleria Alvarez</h3><br>
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
<script src="assets/js/loader.js"></script>
</body>

</html>