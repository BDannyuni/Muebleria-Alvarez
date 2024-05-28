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

// Verifica si se ha proporcionado un ID de producto y un nuevo stock
if (isset($_POST['id']) && isset($_POST['nombre'])) {
    $id = $_POST['id'];
    $nuevoStock = $_POST['nombre'];

    // Actualiza el stock en la base de datos
    $sql = "UPDATE productos SET stock_prod = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nuevoStock, $id);

    if ($stmt->execute()) {
        echo "Stock actualizado correctamente";
    } else {
        echo "Error al actualizar el stock: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de producto o nuevo stock no proporcionado.";
}

$conn->close();
?>
