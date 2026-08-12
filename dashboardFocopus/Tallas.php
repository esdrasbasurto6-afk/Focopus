<?php require_once "vistas/parteSuperior.php"?>
<!--INICIO del contenido PRINCIPAL-->
<div class="container">
<h1>Tallas</h1>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT talla_id, nombre_talla FROM tallas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
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
                        <table id="tablaTallas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre_Talla</th>                      
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['talla_id'] ?></td>
                                <td><?php echo $dat['nombre_talla'] ?></td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formTallas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre_talla" class="col-form-label">Nombre_talla:</label>
                <input type="text" class="form-control" id="nombre_talla">
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