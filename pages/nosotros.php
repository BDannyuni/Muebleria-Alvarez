<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Producto</title>
</head><br><br><br><br><br><br>
<body><br><br><br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre del producto:</label>
        <input type="text" name="name" id="name" required><br><br>
        <label for="description">Codigo:</label>
        <textarea name="description" id="description" required></textarea><br><br>
        <label for="price">Precio:</label>
        <input type="text" name="price" id="price" required><br><br>
        <label for="image">Imagen:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>
        <input type="submit" name="submit" value="Subir Producto">
    </form>
</body>
</html>
