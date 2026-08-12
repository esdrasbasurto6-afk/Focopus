<?php require_once "vistas/parteSuperior.php"?>
<!--INICIO del contenido PRINCIPAL-->
<div class="container">
<h1>Pedidos</h1>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT pedido_id, ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion FROM pedidos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>

 <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <<div class="Container-fluid" style="width: 100%; padding-left: 50px; padding-right: 50px; ">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPedidos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Clave de Transacción</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Paypal Datos</th>
                                <th>Correo</th>
                                <th>Total</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                    <td><?php echo $dat['pedido_id'] ?></td>
                                    <td><?php echo $dat['ClaveTransacion'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['estado'] ?></td>
                                    <td><?php echo $dat['PaypalDatos'] ?></td>
                                    <td><?php echo $dat['Correo'] ?></td>
                                    <td><?php echo $dat['Total'] ?></td>
                                    <td><?php echo $dat['Nombre'] ?></td>
                                    <td><?php echo $dat['Direccion'] ?></td>
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
                        <label for="ClaveTransacion" class="col-form-label">ClaveTransacion:</label>
                        <input type="text" class="form-control" id="ClaveTransacion">
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="col-form-label">fecha:</label>
                        <input type="datetime-local" class="form-control" id="fecha">
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-form-label">estado:</label>
                        <input type="text" class="form-control" id="estado">
                    </div>
                    <div class="form-group">
                        <label for="PaypalDatos" class="col-form-label">PaypalDatos:</label>
                        <textarea class="form-control" id="PaypalDatos"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Correo" class="col-form-label">Correo:</label>
                        <input type="email" class="form-control" id="Correo">
                    </div>
                    <div class="form-group">
                        <label for="Total" class="col-form-label">Total:</label>
                        <input type="text" class="form-control" id="Total">
                    </div>
                    <div class="form-group">
                        <label for="Nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="Direccion" class="col-form-label">Direccion:</label>
                        <input type="text" class="form-control" id="Direccion">
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