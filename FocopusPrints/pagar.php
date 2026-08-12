<script src="https://www.paypal.com/sdk/js?client-id=AfdD0XPJZj6cxy8jTDrtuAgXLidfSsN-xNidgP812QTHzMuKQWTAoYoxGj3DjkWL841wa3hvpga5oX93&currency=MXN"></script>


<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
// session_start(); // Iniciar sesión

if ($_POST) {
    $total = 0;
    $SID = session_id();
    $Correo = $_POST['email'];
    $Nombre = $_POST['Nombre'];
    $Direccion = $_POST['Direccion'];

    foreach ($_SESSION['CARRITO'] as $producto) {
        $total += ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $sentencia = $pdo->prepare("INSERT INTO `pedidos` (`pedido_id`, `ClaveTransacion`, `fecha`, `estado`, `PaypalDatos`, `Correo`, `Total`, `Nombre`, `Direccion`) 
                                VALUES (NULL, :ClaveTransaccion, current_timestamp(), 'pendiente', '', :Correo, :Total, :Nombre, :Direccion)");

    $sentencia->bindParam(":ClaveTransaccion", $SID); // Fixed the parameter name
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Total", $total);
    $sentencia->bindParam(":Nombre", $Nombre);
    $sentencia->bindParam(":Direccion", $Direccion);
    $sentencia->execute();
    $pedido_id = $pdo->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        // Obtener el ID de la talla
        $sentencia_talla = $pdo->prepare("SELECT talla_id FROM tallas WHERE nombre_talla = :nombre_talla");
        $sentencia_talla->bindParam(":nombre_talla", $producto['TALLA']);
        $sentencia_talla->execute();
        $talla = $sentencia_talla->fetch(PDO::FETCH_ASSOC);

        // Obtener el ID del color
        $sentencia_color = $pdo->prepare("SELECT color_id FROM colores WHERE nombre_color = :nombre_color");
        $sentencia_color->bindParam(":nombre_color", $producto['COLOR']);
        $sentencia_color->execute();
        $color = $sentencia_color->fetch(PDO::FETCH_ASSOC);

        // Insertar el detalle del pedido
        $sentencia_detalle = $pdo->prepare("INSERT INTO `detalles_pedidos` (`detalle_pedido_id`, `pedido_id`, `camiseta_id`, `talla_id`, `color_id`, `cantidad`, `precio_unitario`) 
        VALUES (NULL, :pedido_id, :camiseta_id, :talla_id, :color_id, :cantidad, :precio_unitario);");
        $sentencia_detalle->bindParam(":pedido_id", $pedido_id);
        $sentencia_detalle->bindParam(":camiseta_id", $producto['ID']);
        $sentencia_detalle->bindParam(":talla_id", $talla['talla_id']);
        $sentencia_detalle->bindParam(":color_id", $color['color_id']);
        $sentencia_detalle->bindParam(":cantidad", $producto['CANTIDAD']);
        $sentencia_detalle->bindParam(":precio_unitario", $producto['PRECIO']);
        $sentencia_detalle->execute();
    }

    // echo "<h3>" . $total . "</h3>";
}
?>



<style>
    .jumbotron {
        background-color: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .jumbotron h1 {
        font-size: 2.5em;
    }

    .jumbotron h4 {
        font-size: 1.5em;
    }

    .jumbotron p {
        font-size: 1.2em;
    }

    .jumbotron strong {
        font-weight: bold;
    }
    .center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh; /* Ajusta según tus necesidades */
    }


</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="jumbotron text-center">
    


    <img src="PayPal.png" alt="paypal">
    <h1 class="display-4">¡Paso final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con Paypal la cantidad de:
    <h4>$<?php echo number_format($total, 2); ?></h4>
    </p>

    <p>Su comprobante sera otorgado una vez procesado el pago <br>
        <strong>(Para aclaraciones:  contactofocopusprints@gmail.com)</strong>
        <br>
    <!-- <h3>Gracias por comprar en FOCOPUS</h3> -->
    </p>
    <div class="center-container">
    <div id="paypal-button-container"></div>
</div>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Configura el monto del pedido aquí
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo number_format($total, 2); ?>' // Monto total del pedido
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Captura el pago exitoso
                alert('Transacción completada por ' + details.payer.name.given_name);
                // Redirige al usuario o muestra un mensaje de éxito
                window.location.href = "success.php?orderID=" + data.orderID;
            });
        },
        onCancel: function (data) {
            // Maneja la cancelación del pago
            alert('El pago fue cancelado!');
        },
        onError: function (err) {
            // Maneja los errores en el pago
            console.error('Un error acaba de cancelar la compra por medio de Paypal');
        }
    }).render('#paypal-button-container');
</script>




 
</div>




<?php
include 'templates/pie.php';
?>