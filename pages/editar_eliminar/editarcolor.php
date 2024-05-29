<?php
// Establece la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verifica si se ha proporcionado un ID de material
if (isset($_POST['id']) && isset($_POST['nombre'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $hex = $_POST['color'];

    // Actualiza el material en la base de datos
    $sql = "UPDATE color SET color_nom = ?, colorHex = ? WHERE id_color = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $hex, $id);

    if ($stmt->execute()) {
        echo "Color actualizado correctamente";
    } else {
        echo "Error al actualizar el Color: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de material no proporcionado.";
}

$conn->close();
?>