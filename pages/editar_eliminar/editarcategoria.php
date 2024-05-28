<?php
// Establece la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM categorias WHERE id_Categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc();
    } else {
        echo "Categoría no encontrada.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];

    $sql = "UPDATE categorias SET categoria_nom = ?, Estado = ? WHERE id_Categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $estado, $id);

    if ($stmt->execute()) {
        echo "Categoría actualizada.";
    } else {
        echo "Error al actualizar la categoría.";
    }

    $stmt->close();
    $conn->close();

    // Redirigir a la página de categorías
    header('Location: ../departamentos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>
    <form action="editarcategoria.php" method="post">
        <input type="hidden" name="id" value="<?php echo $categoria['id_Categoria']; ?>">
        <label for="nombre">Nombre del Departamento:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $categoria['categoria_nom']; ?>" required><br>
        <label for="estado">Estado del Departamento:</label>
        <input type="text" name="estado" id="estado" value="<?php echo $categoria['Estado']; ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
