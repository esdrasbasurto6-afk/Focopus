<?php require_once "vistas/parteSuperior.php"?>
<!--INICIO del contenido PRINCIPAL-->
<div class="container">
<h1>Detalles Pedido</h1>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT detalle_pedido_id, pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario FROM detalles_pedidos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los nombres de las camisetas
$consulta_camisetas = "SELECT camiseta_id, nombre FROM camisetas";
$resultado_camisetas = $conexion->prepare($consulta_camisetas);
$resultado_camisetas->execute();
$camisetas = $resultado_camisetas->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los nombres de las tallas
$consulta_tallas = "SELECT talla_id, nombre_talla FROM tallas";
$resultado_tallas = $conexion->prepare($consulta_tallas);
$resultado_tallas->execute();
$tallas = $resultado_tallas->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los nombres de los colores
$consulta_colores = "SELECT color_id, nombre_color FROM colores";
$resultado_colores = $conexion->prepare($consulta_colores);
$resultado_colores->execute();
$colores = $resultado_colores->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaDetalles" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Pedido Id</th>
                                <th>Camiseta Id</th>                                
                                <th>Talla Id</th>  
                                <th>Color Id</th>  
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['detalle_pedido_id'] ?></td>
                                <td><?php echo $dat['pedido_id'] ?></td>
                                <td><?php echo $dat['camiseta_id'] ?></td>
                                <td><?php echo $dat['talla_id'] ?></td> 
                                <td><?php echo $dat['color_id'] ?></td>    
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['precio_unitario'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
           <form id="formPedidos">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pedido_id" class="col-form-label">Pedido_id:</label>
                        <input type="number" class="form-control" id="pedido_id">
                    </div>
                    
                   <div class="form-group">
                    <label for="camiseta_id" class="col-form-label">Camiseta:</label>
                    <select id="camiseta_id" class="form-control">
                        <option value="">Selecciona una camiseta</option>
                        <?php foreach ($camisetas as $camiseta) { ?>
                            <option value="<?php echo $camiseta['camiseta_id']; ?>"><?php echo $camiseta['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                    
                <div class="form-group">
                    <label for="talla_id" class="col-form-label">Talla:</label>
                    <select id="talla_id" class="form-control">
                        <option value="">Selecciona una talla</option>
                        <?php foreach ($tallas as $talla) { ?>
                            <option value="<?php echo $talla['talla_id']; ?>"><?php echo $talla['nombre_talla']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                    
                    <div class="form-group">
                    <label for="color_id" class="col-form-label">Color:</label>
                    <select id="color_id" class="form-control">
                        <option value="">Selecciona un color</option>
                        <?php foreach ($colores as $color) { ?>
                            <option value="<?php echo $color['color_id']; ?>"><?php echo $color['nombre_color']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                    <div class="form-group">
                    <label for="cantidad" class="col-form-label">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad">
                </div> 
                    <div class="form-group">
                    <label for="precio_unitario" class="col-form-label">Precio Unitario:</label>
                    <input type="number" class="form-control" id="precio_unitario">
                </div> 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>

            
        </div>
    </div>
</div>
      
<!-- Modal de confirmación personalizada -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>¿Está seguro de eliminar el registro?</p>
            <button id="confirmYes" class="btn btn-danger">Sí</button>
            <button id="confirmNo" class="btn btn-secondary">No</button>
        </div>
    </div>


<!--FIN DEL CONTENIDO PRINCIPAL-->
<?php require_once "vistas/parteInferior.php"?>