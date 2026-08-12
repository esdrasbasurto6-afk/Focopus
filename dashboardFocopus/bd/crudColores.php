<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre_color = (isset($_POST['nombre_color'])) ? $_POST['nombre_color'] : '';
$color_id = (isset($_POST['color_id'])) ? $_POST['color_id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    

switch($opcion){
    case 1: //insertar
        $consulta = "INSERT INTO colores (nombre_color) VALUES('$nombre_color')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT color_id, nombre_color FROM colores ORDER BY color_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
    case 2: //modificación
        $consulta = "UPDATE colores SET nombre_color='$nombre_color' WHERE color_id='$color_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT color_id, nombre_color FROM colores WHERE color_id='$color_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
    case 3://baja
        $consulta = "DELETE FROM colores WHERE color_id='$color_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;          
        
}


        

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
