<?php 
$message = '';

if (isset($_POST['btn-accion'])) {
    switch ($_POST['btn-accion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                $message = "ID CORRECTO " . $id;
            } else {
                $message = 'ID incorrecto .-.';
            }
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                $message = "Nombre no alterado.";
            } else {
                $message = "Ups, algo paso con el nombre del producto.";
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $message = "la cantidad está correcta";
            } else {
                $message = "Ups, algo paso con la cantidad del producto.";
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                $message = "El precio está correcto";
            } else {
                $message = "Ups, algo paso con el precio del producto.";
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'precio' => $precio
                );
                $_SESSION['CARRITO'][0] = $producto;
            } else {
                $idProductos = array_column($_SESSION['CARRITO'], 'id');
                if (in_array($id, $idProductos)) {
                    $index = array_search($id, $idProductos);
                    $_SESSION['CARRITO'][$index]['cantidad'] += $cantidad;
                } else {
                    $numeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'precio' => $precio
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                }
            }
            break;
        case 'Eliminar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['id'] == $id) {
                        unset($_SESSION['CARRITO'][$indice]);
                        $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']);
                    }
                }
                $message = "Producto eliminado";
            } else {
                $message = 'No se pudo eliminar';
            }
            break;
        case 'buy':
            $mensaje = "Compra realizada con éxito.";
            unset($_SESSION['CARRITO']);
            exit;
            break;
    }
}

?>