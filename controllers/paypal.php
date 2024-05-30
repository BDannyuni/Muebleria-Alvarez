<?php
include "carrito.php";
include "user_session.php";
//incluimos el ticket
include "ticket.php";
// Cargar la librería de Dompdf
require_once "dompdf/vendor/autoload.php";
// Importar la clase Dompdf
use Dompdf\Dompdf;
# Current Time
date_default_timezone_set("America/Mexico_City");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    #echo "funcion registrar compra";
    // Recupera los datos JSON enviados en la solicitud
    $data = file_get_contents('php://input');
    // Extrae los detalles de la orden del JSON
    $json = json_decode($data, true);
    $pedidos = $json['pedidos'];
    $productos = $json['productos'];
    #print_r($json);
    if (is_array($pedidos) && is_array($productos)) {
        // Recupera el ID de usuario del usuario actual
        $userid = $user['id_usuario'];
        $monto_total = $pedidos['purchase_units'][0]['amount']['value'];
        $fecha_venta = date('Y-m-d H:i:s');
        $email = $pedidos['payer']['email_address'];
        $nombre = $pedidos['payer']['name']['given_name'];
        $apellido = $pedidos['payer']['name']['surname'];
        $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
        $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['admin_area_2'];
        $status = $pedidos['status'];
        $order_id = $pedidos['id'];
        registrar_venta($userid, $monto_total, $fecha_venta, $email, $nombre, $apellido, $direccion, $ciudad, $status, $order_id, $conn);
        if ($data > 0) {
            foreach ($productos as $producto) {
                // traer los productos
                $temp = get_productos($producto['id'], $conn);
                //traer el id venta con el orderID
                $temp2 = get_venta($order_id, $conn);
                registrar_detalle($temp2['id_venta'], $producto['id'], $producto['cantidad'], $producto['precio'], $conn);
                $respuesta = "success";
            }
            // Generar el ticket
            generar_ticket($temp2['id_venta'], $productos, $monto_total, $nombre, $apellido, $email, $direccion, $ciudad, $fecha_venta);
            // Redireccionar a la página de inicio
            header("Location: ../index.php");

            // Finalizamos la sesión del carrito
            unset($_SESSION['CARRITO']);
        } else {
            echo "Error al registrar";
        }
    } else {
        echo "Error fatal, no modifiques el JSON";
    }
}
function get_productos($id_producto, $conn)
{
    $sqlQuery = "SELECT * FROM productos WHERE id_producto = :id";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindParam(':id', $id_producto);
    $stmt->execute();
    return $stmt->fetch();
}

function get_venta($order_id, $conn)
{
    $sqlQuery = "SELECT * FROM ventas WHERE orderID = :orderID";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindParam(':orderID', $order_id);
    $stmt->execute();
    return $stmt->fetch();
}
function registrar_venta($userid, $monto_total, $fecha_venta, $email, $nombre, $apellido, $direccion, $ciudad, $status, $order_id, $conn)
{
    $sqlQuery = "INSERT INTO ventas (id_usuario, monto_total, fecha_venta, email, nombre, apellido, direccion, ciudad, estado, orderID) VALUES (:userid, :monto_total, :fecha_venta, :email, :nombre, :apellido, :direccion, :ciudad, :estado, :orderID)";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':monto_total', $monto_total);
    $stmt->bindParam(':fecha_venta', $fecha_venta);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':estado', $status);
    $stmt->bindParam(':orderID', $order_id);
    if ($stmt->execute()) {
        //echo "Registro exitoso";
    } else {
        echo "Error al registrar";
    }
}

function registrar_detalle($id_venta, $id_producto, $cantidad, $precio, $conn)
{
    $sqlQuery = "INSERT INTO detalles_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (:id_venta, :id_producto, :cantidad, :precio_unitario)";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindParam(':id_venta', $id_venta);
    $stmt->bindParam(':id_producto', $id_producto);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':precio_unitario', $precio);
    if ($stmt->execute()) {
        //echo "Registro exitoso";
        //RESTARLE AL STOCK DE CADA PRODUCTO
        $sqlQuery2 = "UPDATE productos SET stock_prod = stock_prod - :stock WHERE id_producto = :id";
        $stmt2 = $conn->prepare($sqlQuery2);
        $stmt2->bindParam(':stock', $cantidad);
        $stmt2->bindParam(':id', $id_producto);
        $stmt2->execute();
        if (!$stmt2->execute()) {
            echo "Error al restar del stock.";
            return false;
        }
        //echo "Registro exitoso";
    } else {
        echo "Error al registrar";
    }
}

// Función para generar el ticket
function generar_ticket($id_venta)
{
    //GENERA TICKET
    // Crear instancia de Dompdf
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');
    $dompdf->setPaper('a5');

    include "ticket.php"; // Incluir el contenido del ticket

    // Cargar el HTML generado anteriormente
    $dompdf->loadHtml($html);
    // Renderizar el PDF
    $dompdf->render();

    // Guardar el PDF en la carpeta ../tickets
    $ticket_path = '../tickets/ticket_' . $id_venta . '.pdf';
    file_put_contents($ticket_path, $dompdf->output());

    // Enviar el PDF al navegador para que se abra en una nueva pestaña
    $dompdf->stream('ticket_' . $id_venta . '.pdf', array('Attachment' => 0));

    // Finalizar la sesión del carrito
    unset($_SESSION['CARRITO']);
}
