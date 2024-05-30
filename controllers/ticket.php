<?php ob_start(); //para limpiar el contenido y se pueda insertar dentro del convertidor a pdf ?>

<!-- CONTENIDO DEL TICKET -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php 
        // Cálculo del total incluyendo envío e impuesto
        $total_sin_envio = 0;
        foreach($_SESSION['CARRITO'] as $indice => $producto){
            $total_sin_envio += $producto['precio'] * $producto['cantidad'];
        }
        $impuesto = $total_sin_envio * 0.16;
        $total_con_impuesto = $total_sin_envio + $impuesto;
        $envio = 10;
        $total_con_envio = $total_con_impuesto + $envio;
    ?>
    <p class="fecha">Fecha: <?php echo date("Y-m-d H:i:s"); ?></p>
    <h1>MUEBLERIA ALVAREZ</h1>
    <h4>Ticket de compra</h4>
    <p>**********************************************************</p>
    <h3>Productos:</h3>
    <div>
        <!-- TABLA DE PRODUCTOS -->
        <table class="sample">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr> 
            </thead>
            <tbody>
                <?php $total = 0; ?> <!-- TOTAL -->
                <?php foreach($_SESSION['CARRITO'] as $indice => $producto){ ?> <!-- Recorre la db para mostrar los productos en el carrito -->
                <tr>
                    <td><?php echo $producto['nombre'] ?></td>
                    <td align="center"><?php echo $producto['cantidad'] ?></td>
                    <td align="center"><?php echo $producto['precio'] ?></td>
                    <td align="center"><?php echo number_format($producto['precio'] * $producto['cantidad'], 2)?></td>    
                </tr>
                <?php $total += $producto['precio'] * $producto['cantidad']; ?> <!-- TOTAL -->
                <?php  } ?>
            </tbody>
        </table>
    </div>
    <p class="p">Total antes de impuestos: $<?php echo number_format($total_sin_envio, 2); ?></p>
    <p class="p">Impuestos (16%): $<?php echo number_format($impuesto, 2); ?></p>
    <p class="p">Envío: $<?php echo number_format($envio, 2); ?></p>
    <p class="p">Total: $<?php echo number_format($total_con_envio, 2); ?></p>
    <p>**********************************************************</p>
    <p class="footer">"Favor de guardar este ticket para cualquier queja o reembolso en alguno de nuestros productos"</p>
    <p class="footer">muebleriaalvarez.com</p>
    <p>**********************************************************</p>                
    <p class="footer">¡GRACIAS POR TU COMPRA!</p>

    <style>
        .fecha{
            text-align: end;
        }
        table{
            margin: 0 auto;
        }
        h1{
            text-align: center;
        }
        h2{
            text-align: center;
        }
        .h3{
            text-align: center;
        }
        h4{
            text-align: center;
        }
        .p{
            text-align:end;
        }
        .footer{
            text-align: center;
        }
    </style>
</body>
</html>
<?php 
    $html = ob_get_clean();
?>
