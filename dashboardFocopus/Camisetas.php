<?php require_once "vistas/parteSuperior.php"?>
<!--INICIO del contenido PRINCIPAL-->
<div class="container">
<h1>Camisetas</h1>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT camiseta_id, nombre, precio, categoria_id, imagen, Descripcion FROM camisetas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener las categorías
$consulta_categorias = "SELECT categoria_id, nombre_categoria FROM categorias";
$resultado_categorias = $conexion->prepare($consulta_categorias);
$resultado_categorias->execute();
$categorias = $resultado_categorias->fetchAll(PDO::FETCH_ASSOC);

?>

   <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoCamiseta" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <<div class="Container-fluid" style="width: 100%; padding-left: 50px; padding-right: 50px; ">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCamiseta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>                                
                                <th>Categoria</th>  
                                <th>Imagen</th> 
								<th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['camiseta_id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['precio'] ?></td>
                                <td><?php echo $dat['categoria_id'] ?></td> 
                                <td><?php echo $dat['imagen'] ?></td>  
								<td><?php echo $dat['Descripcion'] ?></td> 
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
<div class="modal fade" id="modalCRUDCamiseta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formCamisetas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="precio" class="col-form-label">Precio:</label>
                <input type="number" class="form-control" id="precio">
                </div> 
				
               <div class="form-group">
					<label for="categoria_id" class="col-form-label">Categoria:</label>
					<select id="categoria_id" class="form-control">
						<option value="">Selecciona una categoría</option>
						<?php foreach ($categorias as $categoria) { ?>
							<option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
						<?php } ?>
					</select>
				</div> 
				
                <div class="form-group">
                <label for="imagen" class="col-form-label">Imagen:</label>
                <input type="text" class="form-control" id="imagen">
                </div>
				
				<div class="form-group">
                <label for="Descripcion" class="col-form-label">Descripción:</label>
                <input type="text" class="form-control" id="Descripcion">
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
    <div id="confirmModalCamiseta" class="modal">
        <div class="modal-content">
            <p>¿Está seguro de eliminar el registro?</p>
            <button id="confirmYesCamiseta" class="btn btn-danger">Sí</button>
            <button id="confirmNoCamiseta" class="btn btn-secondary">No</button>
        </div>
    </div>

      <style>
          
/* Estilos para la modal de confirmación personalizada */
.modal {
    display: none; /* Ocultar por defecto */
    position: fixed;
    z-index: 1050; /* Asegúrate de que esté por encima del contenido principal */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
      </style>


<!--FIN DEL CONTENIDO PRINCIPAL-->
<?php require_once "vistas/parteInferior.php"?>