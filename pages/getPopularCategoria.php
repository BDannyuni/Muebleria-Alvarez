<?php
// Establecer conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener categorías populares
$sql = "SELECT c.categoria_nom AS categoria, COUNT(v.id_producto) AS total_vendido
        FROM ventas v
        JOIN productos p ON v.id_producto = p.id_producto
        JOIN categorias c ON p.categoria_prod = c.id_Categoria
        GROUP BY c.categoria_nom
        ORDER BY total_vendido DESC
        LIMIT 5"; // Limitar a las 5 categorías más populares

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>