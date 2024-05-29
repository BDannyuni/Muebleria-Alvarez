<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT dep.departamento_nom, SUM(v.cantidad) as total_vendido 
FROM ventas v 
JOIN productos p ON v.id_producto = p.id_producto
JOIN departamentos dep ON p.id_departamento = dep.id_departamento 
GROUP BY dep.departamento_nom 
ORDER BY total_vendido DESC 
LIMIT 10";
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
