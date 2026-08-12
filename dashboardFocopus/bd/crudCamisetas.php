<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$categoria_id = (isset($_POST['categoria_id'])) ? $_POST['categoria_id'] : '';
$imagen = (isset($_POST['imagen'])) ? $_POST['imagen'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$camiseta_id = (isset($_POST['camiseta_id'])) ? $_POST['camiseta_id'] : '';
    

switch($opcion){
    case 1: //insertar
        $consulta = "INSERT INTO camisetas (nombre, precio, categoria_id, imagen,Descripcion) VALUES('$nombre', '$precio', '$categoria_id','$imagen','$Descripcion')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT camiseta_id, nombre, precio, categoria_id, imagen, Descripcion FROM camisetas ORDER BY camiseta_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
    case 2: //modificación
        $consulta = "UPDATE camisetas SET nombre='$nombre', precio='$precio', categoria_id='$categoria_id', imagen='$imagen', Descripcion = '$Descripcion' WHERE camiseta_id='$camiseta_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT camiseta_id, nombre, precio, categoria_id, imagen, Descripcion FROM camisetas WHERE camiseta_id='$camiseta_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
    case 3://baja
        $consulta = "DELETE FROM camisetas WHERE camiseta_id='$camiseta_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;          
        
}


        

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
