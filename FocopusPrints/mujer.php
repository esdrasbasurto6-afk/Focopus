<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>


<!-- Header-->
<style>
    .text-amarillo {
        color: yellow;
        font-size: 24px; /* Ajusta el tamaño de la fuente según lo que necesites */
        text-align: center; /* Centra el texto */
        font-family: system-ui, "/Garet-Book.ttf"
    }
    .cuadro-negro {
        background-color: black;
        color: black;
        padding: 50px; /* Ajusta el relleno del cuadro negro según lo que necesites */
        width: auto; /* Ajusta el ancho del cuadro negro según el contenido */
        margin: auto; /* Centra el cuadro negro */
        text-align: center; /* Centra el texto dentro del cuadro */
    }
    .btn-yellow {
    background-color: yellow !important;
    border-color: yellow !important; /* Si quieres que el borde coincida */
    color: black !important; /* Ajusta el color del texto si es necesario */
    }
</style>
</head>
<body>

<div class="cuadro-negro">
<h1 class="text-amarillo ">DAMAS</h1>
<br>
<p class="text-amarillo ">👩</p>
</div>


<?php 
// Consulta a la base de datos para obtener las camisetas
$sentencia=$pdo->prepare("SELECT * FROM camisetas WHERE categoria_id=2");
$sentencia->execute();
$listadeproductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

// Consulta a la base de datos para obtener los colores
$sentencia_colores=$pdo->prepare("SELECT * FROM colores");
$sentencia_colores->execute();
$lista_colores=$sentencia_colores->fetchAll(PDO::FETCH_ASSOC);

// Consulta a la base de datos para obtener las tallas
$sentencia_tallas=$pdo->prepare("SELECT * FROM tallas");
$sentencia_tallas->execute();
$lista_tallas=$sentencia_tallas->fetchAll(PDO::FETCH_ASSOC);
?>

<?php $contador = 0; ?>
<?php foreach($listadeproductos as $producto): ?>
    <?php if($contador % 4 == 0): ?>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center cuadro-negro">
    <?php endif; ?>

    <div class="col bg">
        <section class="bg-AMarino py-3">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" title="<?php echo $producto['imagen'];?>" 
                    src="<?php echo $producto['imagen'];?>" alt="<?php echo $producto['imagen'];?>"
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content="<?php echo $producto['Descripcion'];?>"
                    >
                  
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <span><?php echo $producto['nombre'];?></span>
                            
                            <h5 class="card-title">$<?php echo $producto['precio'];?></h5>
                            <!-- <p class="card-text">Descripcion</p> -->
                            <form action="" method="post">
                                <input type="hidden" name="camiseta_id" id="camiseta_id" value="<?php echo openssl_encrypt($producto['camiseta_id'],COD,KEY);?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY);?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);?>">
                                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                                
                                <!-- Color selection -->
                                <div class="form-group">
                                    <label for="color">Color:</label>
                                    <select name="color" id="color" class="form-control">
                                        <?php foreach($lista_colores as $color): ?>
                                            <option value="<?php echo openssl_encrypt($color['nombre_color'], COD, KEY); ?>">
                                                <?php echo $color['nombre_color']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Size selection -->
                                <div class="form-group">
                                    <label for="talla">Talla:</label>
                                    <select name="talla" id="talla" class="form-control">
                                        <?php foreach($lista_tallas as $talla): ?>
                                            <option value="<?php echo openssl_encrypt($talla['nombre_talla'], COD, KEY); ?>">
                                                <?php echo $talla['nombre_talla']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <button class="btn btn-primary btn-yellow"
                                    name="btnAccion"
                                    value="Agregar"
                                    type="submit"
                                >
                                    Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $contador++; ?>
    <?php if($contador % 4 == 0): ?>
        </div> <!-- Cierra el row -->
    <?php endif; ?>
<?php endforeach; ?>

<!-- Cierra el último row si no se llenó con 4 productos -->
<?php if($contador % 4 != 0): ?>
    </div>
<?php endif; ?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Core theme JS-->
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>

<script src="js/scripts.js"></script>

<?php 
include 'templates/pie.php';
?>