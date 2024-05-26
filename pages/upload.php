<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nombre_prod = $_POST['nombre_prod'];
    $descripcion_prod = $_POST['descripcion_prod'];
    $precio_prod = $_POST['precio_prod'];
    $categoria_prod = $_POST['categoria_prod'];
    $stock_prod = $_POST['stock_prod'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $id_color = $_POST['id_color'];
    $id_material = $_POST['id_material'];
    $id_tapiz = $_POST['id_tapiz'];
    
    // Handle the file upload
    $target_dir = "../assets/images/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image = $_FILES["image"]["name"];
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Database connection
    $conexion = new mysqli("localhost", "root", "", "muebleria");
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    // SQL query to insert the product
    $query = "INSERT INTO productos  (nombre_prod, descripcion_prod, precio_prod, categoria_prod, stock_prod, image, proveedor, marca, id_color, id_material, id_tapiz) 
              VALUES ('$nombre_prod', '$descripcion_prod', '$precio_prod', '$categoria_prod', '$stock_prod', '$image', '$proveedor', '$marca', '$id_color', '$id_material', '$id_tapiz')";

    if ($conexion->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }

    $conexion->close();
}


$conn->close();
?>
