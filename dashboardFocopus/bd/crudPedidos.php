<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$pedido_id = (isset($_POST['pedido_id'])) ? $_POST['pedido_id'] : '';
$ClaveTransacion = (isset($_POST['ClaveTransacion'])) ? $_POST['ClaveTransacion'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$PaypalDatos = (isset($_POST['PaypalDatos'])) ? $_POST['PaypalDatos'] : '';
$Correo = (isset($_POST['Correo'])) ? $_POST['Correo'] : '';
$Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$data = array(); // Arreglo para almacenar los datos que se enviarán como respuesta

try {
    switch($opcion){
        case 1: // Insertar
            $consulta = "INSERT INTO pedidos (ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion) VALUES ('$ClaveTransacion', '$fecha', '$estado', '$PaypalDatos', '$Correo', '$Total', '$Nombre', '$Direccion')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT pedido_id, ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion FROM pedidos ORDER BY pedido_id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 2: // Modificación
            $consulta = "UPDATE pedidos SET ClaveTransacion='$ClaveTransacion', fecha='$fecha', estado='$estado', PaypalDatos='$PaypalDatos', Correo='$Correo', Total='$Total', Nombre='$Nombre', Direccion='$Direccion' WHERE pedido_id='$pedido_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT pedido_id, ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion FROM pedidos WHERE pedido_id='$pedido_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 3: // Baja
            $consulta = "DELETE FROM pedidos WHERE pedido_id='$pedido_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    }
} catch (PDOException $e) {
    // Captura cualquier excepción de PDO y la muestra en la salida
    $data['error'] = $e->getMessage();
}

print json_encode($data, JSON_UNESCAPED_UNICODE); // Enviar el array final en formato JSON a JS
$conexion = NULL;
?>
