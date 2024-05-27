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

// Obtener las ventas del mes actual
$sql = "SELECT DATE_FORMAT(fecha_venta, '%Y-%m-%d') AS fecha, SUM(total_venta) AS total
        FROM ventas
        WHERE MONTH(fecha_venta) = MONTH(CURRENT_DATE())
        AND YEAR(fecha_venta) = YEAR(CURRENT_DATE())
        GROUP BY DATE_FORMAT(fecha_venta, '%Y-%m-%d')
        ORDER BY fecha_venta";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data[] = array("fecha" => date("Y-m-d"), "total" => 0);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
