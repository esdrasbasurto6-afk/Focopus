<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$pedido_id = (isset($_POST['pedido_id'])) ? $_POST['pedido_id'] : '';
$camiseta_id = (isset($_POST['camiseta_id'])) ? $_POST['camiseta_id'] : '';
$talla_id = (isset($_POST['talla_id'])) ? $_POST['talla_id'] : '';
$color_id = (isset($_POST['color_id'])) ? $_POST['color_id'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$precio_unitario = (isset($_POST['precio_unitario'])) ? $_POST['precio_unitario'] : '';
$detalle_pedido_id = (isset($_POST['detalle_pedido_id'])) ? $_POST['detalle_pedido_id'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opcion) {
    case 1: // Insertar
        $consulta = "INSERT INTO detalles_pedidos (pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario) VALUES ('$pedido_id', '$camiseta_id', '$talla_id', '$color_id', '$cantidad', '$precio_unitario')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        // Obtener el último registro insertado
        $consulta = "SELECT detalle_pedido_id, pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario FROM detalles_pedidos ORDER BY detalle_pedido_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: // Modificación
        $consulta = "UPDATE detalles_pedidos SET pedido_id='$pedido_id', camiseta_id='$camiseta_id', talla_id='$talla_id', color_id='$color_id', cantidad='$cantidad', precio_unitario='$precio_unitario' WHERE detalle_pedido_id='$detalle_pedido_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        $consulta = "SELECT detalle_pedido_id, pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario FROM detalles_pedidos WHERE detalle_pedido_id='$detalle_pedido_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 

    case 3:// Baja
        $consulta = "DELETE FROM detalles_pedidos WHERE detalle_pedido_id='$detalle_pedido_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        break;  
}

print json_encode($data, JSON_UNESCAPED_UNICODE); // Enviar el array final en formato json a JS
$conexion = NULL;
?>
