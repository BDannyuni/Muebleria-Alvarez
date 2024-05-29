<?php
include "../../controllers/db.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_departamento = $_GET['id'];

    $sql = "SELECT * FROM departamentos WHERE id_departamento = :id_departamento";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_departamento', $id_departamento);
    $stmt->execute();
    $departamento = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_departamento = $_POST['id_departamento'];
    $nombre_departamento = $_POST['departamento_nom'];
    $estado_departamento = $_POST['Estado'];
    // Debugging statements
    echo "ID: $id_departamento, Nombre: $nombre_departamento, Estado: $estado_departamento";

    $sql = "UPDATE departamentos SET departamento_nom = :nombre_departamento, Estado = :Estado WHERE id_departamento = :id_departamento";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_departamento', $id_departamento);
    $stmt->bindParam(':departamento_nom', $nombre_departamento);
    $stmt->bindParam(':Estado', $estado_departamento);

    if ($stmt->execute()) {
        header("Location: ../departamentos.php"); // Redirige a la página principal después de editar.
    } else {
        echo "Error al editar el departamento.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar departamento</title>
</head>

<body>
    <h1>Editar departamento</h1>
    <form action="editarcategoria.php" method="post">
        <input type="hidden" name="id_departamento" value="<?php echo $departamento['id_departamento']; ?>">
        <label for="departamento_nom">Nombre del Departamento:</label>
        <input type="text" name="departamento_nom" id="departamento_nom" value="<?php echo $departamento['departamento_nom']; ?>" required><br>
        <label for="Estado">Estado del Departamento:</label>
        <input type="text" name="Estado" id="Estado" value="<?php echo $departamento['Estado']; ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>
</body>

</html>