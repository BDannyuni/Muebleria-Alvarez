<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos más nuevos (por ejemplo, los 3 más recientes)
$sql = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT 3";
$result = $conn->query($sql);

$productos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Ajustar la ruta de la imagen
        $row['image'] = str_replace('../', '', $row['image']);
        $productos[] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
