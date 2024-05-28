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

// Verifica si se ha recibido el nombre del material
if(isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];

    // Inserta el material en la base de datos
    $sql = "INSERT INTO color (color_nom) VALUES ('$nombre')";

    if ($conn->query($sql) === TRUE) {
        // Envía una respuesta JSON de éxito
        echo json_encode(array('success' => true));
    } else {
        // Envía una respuesta JSON de error
        echo json_encode(array('success' => false, 'message' => 'Error al agregar el material: ' . $conn->error));
    }
} else {
    // Envía una respuesta JSON de error si no se recibió el nombre del material
    echo json_encode(array('success' => false, 'message' => 'No se recibió el nombre del material'));
}

// Cierra la conexión
$conn->close();
?>
