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

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $estado_categoria = $_POST['estado_categoria'];

    // Inserta los datos en la tabla "categorias"
    $sql = "INSERT INTO categorias (id_Categoria, categoria_nom, Estado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_categoria, $nombre_categoria, $estado_categoria);

    if ($stmt->execute()) {
        echo "Categoría agregada exitosamente";
    } else {
        echo "Error al agregar la categoría: " . $conn->error;
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();
}

// Redirige a la página principal después de la inserción
header("Location: ../departamentos.php");
exit();
?>

