<?php
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
// Consulta para obtener los productos más populares
$sql = "SELECT LEFT(p.nombre_prod, 20) AS nombre_acortado, SUM(v.cantidad) as total_vendido
        FROM detalles_venta v
        INNER JOIN productos p ON v.id_producto = p.id_producto
        GROUP BY v.id_producto
        ORDER BY total_vendido DESC
        LIMIT 6";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
