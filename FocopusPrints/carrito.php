<?php
session_start();

$mensaje="";

$ID = $NOMBRE = $CANTIDAD = $PRECIO = $TALLA = $COLOR = "";

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['camiseta_id'], COD, KEY))){
                $ID = openssl_decrypt($_POST['camiseta_id'], COD, KEY);
                $mensaje .= "ok ID correcto".$ID."<br/>";
            }else{
                $mensaje .= "ID incorrecto"."<br/>";
            }

            if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY))){
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje .= "ok Nombre correcto".$NOMBRE."<br/>";
            }else{
                $mensaje .= "nombre incorrecto"."<br/>";
                break;
            }

            if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))){
                $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje .= "ok cantidad correcto".$CANTIDAD."<br/>";
            }else{
                $mensaje .= "Cantidad incorrecta"."<br/>";
                break;
            }

            if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje .= "ok precio correcto".$PRECIO."<br/>";
            }else{
                $mensaje .= "precio incorrecto"."<br/>";
                break;
            }

            if(is_string(openssl_decrypt($_POST['talla'], COD, KEY))){
                $TALLA = openssl_decrypt($_POST['talla'], COD, KEY);
                $mensaje .= "ok talla correcta".$TALLA."<br/>";
            }else{
                $mensaje .= "talla incorrecta"."<br/>";
                break;
            }

            if(is_string(openssl_decrypt($_POST['color'], COD, KEY))){
                $COLOR = openssl_decrypt($_POST['color'], COD, KEY);
                $mensaje .= "ok color correcto".$COLOR."<br/>";
            }else{
                $mensaje .= "color incorrecto"."<br/>";
                break;
            }

            if(!isset($_SESSION['CARRITO'])){
                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO,
                    'TALLA' => $TALLA,
                    'COLOR' => $COLOR
                );
                $_SESSION['CARRITO'][0] = $producto;
            }else{
                $NumeroProductos = count($_SESSION['CARRITO']);
                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO,
                    'TALLA' => $TALLA,
                    'COLOR' => $COLOR
                );
                $_SESSION['CARRITO'][$NumeroProductos] = $producto;
            }
            $mensaje = print_r($_SESSION, true);

            // Redirigir después de procesar el formulario
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;

            break;
        
        case "Eliminar":
            if(is_numeric(openssl_decrypt($_POST['camiseta_id'], COD, KEY))){
                $ID = openssl_decrypt($_POST['camiseta_id'], COD, KEY);
                foreach($_SESSION['CARRITO'] as $indice => $producto){
                    if($producto['ID'] == $ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        break;
                    }
                }
            }else{
                $mensaje .= "ID Incorrecta"."<br/>";
            }

            // Redirigir después de procesar el formulario
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;

            break;
    }
}
?>
