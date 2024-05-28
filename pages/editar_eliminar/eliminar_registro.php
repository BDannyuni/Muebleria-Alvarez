<?php
// Establece la conexión con la base de datos
$servername = "localhost"; // Cambia localhost por el nombre del servidor si es necesario
$username = "root";
$password = "";
$dbname = "muebleria";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtén los datos enviados por AJAX
$id = $_POST['id'];
$tipo = $_POST['tipo'];

// Define la consulta SQL para eliminar el registro según el tipo
switch ($tipo) {
    case 'material':
        $sql = "DELETE FROM material WHERE id_material = $id";
        break;
    case 'color':
        $sql = "DELETE FROM color WHERE id_color = $id";
        break;
    case 'tapiz':
        $sql = "DELETE FROM tapiz WHERE id_tapiz = $id";
        break;
    default:
        echo "Tipo de registro no válido";
        exit();
}

// Ejecuta la consulta
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error al eliminar el registro: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>
