<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';
session_start(); // Iniciar sesión

// Verifica que el pedido ID y orderID estén presentes en la URL
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // Obtén el ID de la sesión actual (SID)
    $SID = session_id();

    // Actualiza el estado del pedido y la clave de transacción en la base de datos
    $sentencia = $pdo->prepare("UPDATE `pedidos` SET `ClaveTransacion` = :ClaveTransaccion, `estado` = 'Pagado' WHERE `ClaveTransacion` = :SID AND `estado` = 'pendiente'");
    $sentencia->bindParam(":ClaveTransaccion", $orderID);
    $sentencia->bindParam(":SID", $SID);
    $sentencia->execute();
    unset($_SESSION['CARRITO']);
    session_destroy();

    // Verifica si la actualización fue exitosa
    if ($sentencia->rowCount() > 0) {
        // Mensaje de agradecimiento
        echo "<div class='d-flex justify-content-center align-items-center vh-100'>";
        echo "<div class='jumbotron text-center'>";
        echo "<h1 class='display-4'>¡Gracias por tu compra!</h1>";
        echo "<p class='lead'>Tu pago ha sido procesado exitosamente.</p>";
        echo "<hr class='my-4'>";
        echo "<p>ID de pago de PayPal: <strong>$orderID</strong></p>";
        echo "<a class='btn btn-primary btn-lg' href='index.php' role='button'>Volver a la tienda</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='d-flex justify-content-center align-items-center vh-100'>";
        echo "<div class='jumbotron text-center'>";
        echo "<h1 class='display-4'>¡Algo salió mal!</h1>";
        echo "<p class='lead'>No se pudo completar tu pago. Por favor, contacta al soporte.</p>";
        echo "<hr class='my-4'>";
        echo "<a class='btn btn-primary btn-lg' href='index.php' role='button'>Volver a la tienda</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='d-flex justify-content-center align-items-center vh-100'>";
    echo "<div class='jumbotron text-center'>";
    echo "<h1 class='display-4'>¡Algo salió mal!</h1>";
    echo "<p class='lead'>No se pudo completar tu pago.</p>";
    echo "<hr class='my-4'>";
    echo "<a class='btn btn-primary btn-lg' href='index.php' role='button'>Volver a la tienda</a>";
    echo "</div>";
    echo "</div>";
}

include 'templates/pie.php';
?>
