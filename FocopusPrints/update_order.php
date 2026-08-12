<?php
include 'global/config.php';
include 'global/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $orderID = $data['orderID'];
    $transactionID = $data['transactionID'];

    // Actualizar el estado del pedido y la clave de transacción
    $sentencia = $pdo->prepare("UPDATE `pedidos` SET `ClaveTransacion` = :transactionID, `estado` = 'pagado' WHERE `pedido_id` = :orderID");
    $sentencia->bindParam(":transactionID", $transactionID);
    $sentencia->bindParam(":orderID", $orderID);
    $sentencia->execute();

    if ($sentencia->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
