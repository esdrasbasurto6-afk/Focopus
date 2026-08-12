<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre_talla = (isset($_POST['nombre_talla'])) ? $_POST['nombre_talla'] : '';
$talla_id = (isset($_POST['talla_id'])) ? $_POST['talla_id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    

switch($opcion){
    case 1: //insertar
        $consulta = "INSERT INTO tallas (nombre_talla) VALUES('$nombre_talla')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT talla_id, nombre_talla FROM tallas ORDER BY talla_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
    case 2: //modificación
        $consulta = "UPDATE tallas SET nombre_talla='$nombre_talla' WHERE talla_id='$talla_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT talla_id, nombre_talla FROM tallas WHERE talla_id='$talla_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
    case 3://baja
        $consulta = "DELETE FROM tallas WHERE talla_id='$talla_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;          
        
}


        

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
