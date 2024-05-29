<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT departamento_nom, COUNT(*) as count FROM productos p INNER JOIN departamentos dep on dep.id_departamento=p.id_departamento GROUP BY departamento_nom ORDER BY count DESC LIMIT 10";
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