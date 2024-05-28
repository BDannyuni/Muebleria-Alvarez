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

// Consulta para obtener ventas por categoría
$sql = "SELECT c.categoria_nom AS categoria, SUM(v.monto) AS total
        FROM ventas v
        JOIN productos p ON v.producto_id = p.id_producto
        JOIN categorias c ON p.categoria_id = c.id_Categoria
        GROUP BY c.categoria_nom";

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
