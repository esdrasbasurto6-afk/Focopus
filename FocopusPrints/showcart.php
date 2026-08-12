<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<style>
    body {
        background-color: black;
        color: yellow; /* Cambiar el color del texto a amarillo */
    }
    .texto {
        font-family: 'Garamond-Book', serif;
    }
    .table {
        color: black; /* Cambiar el color del texto de la tabla a negro */
        background-color: white; /* Ensure table background is white */
    }
    .table th, .table td {
        vertical-align: middle; /* Center align table content vertically */
    }
    .bg-AMarino {
        background-color: #003366; /* Replace with actual color code if needed */
        color: yellow;
        padding: 10px;
        text-align: center;
    }
    .btn-danger {
        background-color: red;
        color: white;
    }
    .btn-primary {
        background-color: blue;
        color: white;
    }
    .alert-warning {
        background-color: #ffcc00;
        color: black;
    }
    .form-control {
        margin-bottom: 10px;
    }
</style>
<br>
<h3 class="bg-AMarino">Lista de carritos</h3>
<?php 
if(!empty($_SESSION['CARRITO'])){
?>
<table class="table table-light table-bordered">
    <thead>
        <tr>
            <th width="30%">Descripcion</th>
            <th width="10%" class="text-center">Talla</th>
            <th width="10%" class="text-center">Color</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="15%" class="text-center">Precio</th>
            <th width="15%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0;?>
        <?php 
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
        ?>
        <tr>
            <td width="30%"><?php echo $producto['NOMBRE'] ?></td>
            <td width="10%" class="text-center"><?php echo $producto['TALLA']; ?></td>
            <td width="10%"class="text-center"><?php echo $producto['COLOR']; ?></td>
            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
            <td width="15%" class="text-center"><?php echo $producto['PRECIO'] ?></td>
            <td width="15%" class="text-center"><?php echo number_format( $producto['CANTIDAD']*$producto['PRECIO'],2) ?></td>
            <td width="5%">
                <form action="" method="post">
                    <input type="hidden" name="camiseta_id" id="camiseta_id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total=$total+( $producto['CANTIDAD']*$producto['PRECIO']);?>
        <?php } ?>
        <tr>
            <td colspan="5" class="text-right"><h3>Total</h3></td>
            <td class="text-center"><h3>$<?php echo number_format($total,2) ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="7">
                <form action="pagar.php" method="post">
                    <div class="alert alert-warning">
                        <div class="form-group">
                            <label for="my-input">Correo de contacto</label>
                            <input type="email" name="email" class="form-control" placeholder="Por favor escribe tu correo" required> 
                            <input type="text" name="Nombre" class="form-control" placeholder="Inserte Su Nombre" required>
                            <input type="text" name="Direccion" class="form-control" placeholder="Domicilio Completo" required>     
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            Los productos serán enviados a este correo.
                        </small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">Proceder a pagar</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
<?php } else { ?>
    <div class="alert alert-warning"> No hay productos en el carrito</div>
<?php } ?>
<?php 
include 'templates/pie.php';
?>
