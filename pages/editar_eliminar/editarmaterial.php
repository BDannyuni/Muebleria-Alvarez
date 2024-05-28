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

    // Actualiza el material en la base de datos
    $sql = "UPDATE material SET material_nom = ? WHERE id_material = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
        echo "Material actualizado correctamente";
    } else {
        echo "Error al actualizar el material: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de material no proporcionado.";
}

$conn->close();
?>