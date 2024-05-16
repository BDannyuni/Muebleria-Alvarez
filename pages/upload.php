<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $image = $_FILES['image'];

    // Verificar si se subió el archivo
    if ($image['error'] == UPLOAD_ERR_OK) {
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];
        $imageType = $image['type'];

        // Obtener la extensión del archivo
        $imageExt = explode('.', $imageName);
        $imageActualExt = strtolower(end($imageExt));

        // Extensiones permitidas
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // Verificar si la extensión es permitida
        if (in_array($imageActualExt, $allowed)) {
            // Verificar si no hay errores
            if ($imageError === 0) {
                // Limitar el tamaño del archivo (por ejemplo, 5MB)
                if ($imageSize < 5000000) {
                    // Crear un nombre único para la imagen
                    $imageNewName = uniqid('', true) . "." . $imageActualExt;
                    $imageDestination = '../assets/images/uploads/' . $imageNewName;

                    // Mover el archivo subido a la carpeta de destino
                    if (move_uploaded_file($imageTmpName, $imageDestination)) {
                        // Insertar los datos en la base de datos
                        $sql = "INSERT INTO productos (nombre, codigo_producto , precio, image) VALUES ('$name', '$description', '$price', '$imageDestination')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Producto subido exitosamente";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error al mover el archivo subido.";
                    }
                } else {
                    echo "Tu archivo es demasiado grande.";
                }
            } else {
                echo "Hubo un error subiendo tu archivo.";
            }
        } else {
            echo "No puedes subir archivos de este tipo.";
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
}

$conn->close();
?>
