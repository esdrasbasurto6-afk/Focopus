<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre_categoria = (isset($_POST['nombre_categoria'])) ? $_POST['nombre_categoria'] : '';
$categoria_id = (isset($_POST['categoria_id'])) ? $_POST['categoria_id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    

switch($opcion){
    case 1: //insertar
        $consulta = "INSERT INTO categorias (nombre_categoria) VALUES('$nombre_categoria')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT categoria_id, nombre_categoria FROM categorias ORDER BY categoria_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
    case 2: //modificación
        $consulta = "UPDATE categorias SET nombre_categoria='$nombre_categoria' WHERE categoria_id='$categoria_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT categoria_id, nombre_categoria FROM categorias WHERE categoria_id='$categoria_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
    case 3://baja
        $consulta = "DELETE FROM categorias WHERE categoria_id='$categoria_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;          
        
}


        

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
