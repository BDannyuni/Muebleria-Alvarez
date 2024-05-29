<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-accion'])) {
    switch ($_POST['btn-accion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                $message = "ID CORRECTO " . $id;
                #echo $message;
            } else {
                $message = 'ID incorrecto .-.';
                #echo $message;
            }
            if (openssl_decrypt($_POST['image'], COD, KEY)) {
                $image = openssl_decrypt($_POST['image'], COD, KEY);
                $message = "Imagen correcta";
                #echo $message;
            } else {
                $message = "Ups, algo pasó con la imagen del producto.";
                #echo $message;
                break;
            }
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                $message = "Nombre no alterado.";
                #echo $message;
            } else {
                $message = "Ups, algo paso con el nombre del producto.";
                #echo $message;
                break;
            }
            if (is_string(openssl_decrypt($_POST['descripcion_prod'], COD, KEY))) {
                $desc = openssl_decrypt($_POST['descripcion_prod'], COD, KEY);
                $message = "la descripción está correcta";
                #echo $message;
            } else {
                $message = "Ups, algo paso con la descripción del producto.";
                #echo $message;
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $message = "la cantidad está correcta";
                #echo $message;
            } else {
                $message = "Ups, algo paso con la cantidad del producto.";
                #echo $message;
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                $message = "El precio está correcto";
                #echo $message;
            } else {
                $message = "Ups, algo paso con el precio del producto.";
                #echo $message;
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'id' => $id,
                    'image' => $image,
                    'nombre' => $nombre,
                    'descripcion_prod' => $desc,
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
                        'image' => $image,
                        'nombre' => $nombre,
                        'descripcion_prod' => $desc,
                        'cantidad' => $cantidad,
                        'precio' => $precio
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                }
            }
            break;
        case 'Actualizar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY)) && is_numeric($_POST['cantidad'])) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                $nuevaCantidad = $_POST['cantidad'];
                #echo $id;
                #echo $nuevaCantidad;
                // Verifica si la nueva cantidad es menor que 1
                if ($nuevaCantidad < 1) {
                    // Llama al caso 'Eliminar'
                    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                        if ($producto['id'] == $id) {
                            unset($_SESSION['CARRITO'][$indice]);
                            // Opcionalmente puedes reorganizar el array si es necesario
                            $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']);
                            break;
                        }
                    }
                } else {
                    // Consultar la base de datos para obtener la cantidad en stock
                    $consultaStock = $conn->prepare("SELECT stock_prod FROM productos WHERE id_producto = :id_producto");
                    $consultaStock->bindParam(":id_producto", $id, PDO::PARAM_INT);
                    $consultaStock->execute();
                    $resultadoStock = $consultaStock->fetch(PDO::FETCH_ASSOC);

                    if ($resultadoStock) {
                        $stockDisponible = $resultadoStock['stock_prod'];

                        // Verificar si la nueva cantidad supera el stock disponible
                        if ($nuevaCantidad > $stockDisponible) {
                            // Si la nueva cantidad supera el stock, asignar la cantidad al máximo disponible
                            $nuevaCantidad = $stockDisponible;
                            $message = "La cantidad seleccionada supera el stock disponible. Se ha ajustado al máximo disponible.";
                        }
                        foreach ($_SESSION['CARRITO'] as &$producto) {
                            if ($producto['id'] == $id) {
                                $producto['cantidad'] = $nuevaCantidad;
                                break;
                            }
                        }
                        unset($producto); // Desreferencia al producto para evitar que afecte a los demas 
                    } else {
                        $message = "Ya no hay stock disponible.";
                    }
                }
            } else {
                $message = "ID o Cantidad Incorrectos";
                #echo $message;
                break;
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

        default:
            // Recupera los datos JSON enviados en la solicitud
            $data = json_decode(file_get_contents('php://input'), true);

            // Extrae los detalles de la orden del JSON
            $orderID = $data['orderID'];
            $orderData = $data['orderData'];
            $purchaseUnits = $orderData['purchase_units'][0];
            $amount = $purchaseUnits['amount']['value'];
            $currency = $purchaseUnits['amount']['currency_code'];
            $userId = $data['userId']; // Asumiendo que el ID del usuario se envía en los datos JSON

            // Inicia la transacción
            $conn->beginTransaction();
            try {
                // Inserta la orden en la tabla ventas
                $stmtVenta = $conn->prepare("INSERT INTO ventas (id_usuario, monto_total, fecha_venta, estado, orderID, currency, orderData) VALUES (?, ?, NOW(), 'COMPLETED', ?, ?, ?)");
                $stmtVenta->bindParam(1, $userId, PDO::PARAM_INT);
                $stmtVenta->bindParam(2, $amount, PDO::PARAM_STR);
                $stmtVenta->bindParam(3, $orderID, PDO::PARAM_STR);
                $stmtVenta->bindParam(4, $currency, PDO::PARAM_STR);
                $stmtVenta->bindParam(5, json_encode($orderData), PDO::PARAM_STR);
                $stmtVenta->execute();
                $idVenta = $conn->lastInsertId();

                // Inserta los detalles de los productos en la tabla detalles_venta
                foreach ($purchaseUnits['items'] as $item) {
                    $productID = $item['product_id'];
                    $quantity = $item['quantity'];
                    $price = $item['unit_amount']['value'];

                    $stmtDetalle = $conn->prepare("INSERT INTO detalles_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
                    $stmtDetalle->bindParam(1, $idVenta, PDO::PARAM_INT);
                    $stmtDetalle->bindParam(2, $productID, PDO::PARAM_INT);
                    $stmtDetalle->bindParam(3, $quantity, PDO::PARAM_INT);
                    $stmtDetalle->bindParam(4, $price, PDO::PARAM_STR);
                    $stmtDetalle->execute();

                    // Actualiza el stock del producto
                    $stmtStock = $conn->prepare("UPDATE productos SET stock_prod = stock_prod - ? WHERE id_producto = ?");
                    $stmtStock->bindParam(1, $quantity, PDO::PARAM_INT);
                    $stmtStock->bindParam(2, $productID, PDO::PARAM_INT);
                    $stmtStock->execute();
                }

                // Confirma la transacción
                $conn->commit();
                echo json_encode(['status' => 'success', 'orderID' => $orderID]);
            } catch (Exception $e) {
                // Revierte la transacción en caso de error
                $conn->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'Failed to save order: ' . $e->getMessage()]);
            }



            unset($_SESSION['CARRITO']);
            break;
    }
}
