<?php require_once "vistas/parteSuperior.php"?>
<!--INICIO del contenido PRINCIPAL-->
<div class="container-fluid" style="background-color: #1c1c1c; padding: 55px;">
    <h1 class="text-center text-light">PÁGINA INICIO</h1>
    <h2 class="text-center text-light">Bienvenido de nuevo!</h2>
    <h3 class="text-center text-light mb-5">Ingresa a una sección:</h3>

    <div class="row">
        <!-- Botón de Camisetas -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #f39c12; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Camisetas</h5>
                    <p class="card-text mb-4">Gestión de productos de camisetas</p>
                    <a href="camisetas.php" class="btn btn-dark btn-lg">Ir a Camisetas</a>
                </div>
            </div>
        </div>

        <!-- Botón de Categorías -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #e74c3c; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Categorías</h5>
                    <p class="card-text mb-4">Gestiona las categorías de productos</p>
                    <a href="categorias.php" class="btn btn-dark btn-lg">Ir a Categorías</a>
                </div>
            </div>
        </div>

        <!-- Botón de Pedidos -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #2ecc71; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Pedidos</h5>
                    <p class="card-text mb-4">Ver y gestionar los pedidos de clientes</p>
                    <a href="pedidos.php" class="btn btn-dark btn-lg">Ir a Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Botón de DetallePedidos -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #2eccb8; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Detalle Pedidos</h5>
                    <p class="card-text mb-4">Ver y gestionar los detalles de los pedidos</p>
                    <a href="Detallespedido.php" class="btn btn-dark btn-lg">Ir a Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Botón de Colores -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #9b59b6; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Colores</h5>
                    <p class="card-text mb-4">Gestiona los colores de los productos</p>
                    <a href="colores.php" class="btn btn-dark btn-lg">Ir a Colores</a>
                </div>
            </div>
        </div>

        <!-- Botón de Tallas -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-center" style="background-color: #f39c12; color: white; height: 100%; border-radius: 10px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-4">Tallas</h5>
                    <p class="card-text mb-4">Gestiona las tallas de los productos</p>
                    <a href="tallas.php" class="btn btn-dark btn-lg">Ir a Tallas</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FIN DEL CONTENIDO PRINCIPAL-->
<?php require_once "vistas/parteInferior.php"?>

<!-- Agregar estilos para que la página tenga un fondo creativo negro y amarillo -->
<style>
    body {
        background-color: #1c1c1c;
        color: white;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-size: 1.5em;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.2em;
        margin-bottom: 1.5em;
    }

    .btn-dark {
        background-color: #333;
        border-color: #333;
        font-size: 1.1em;
        padding: 15px 30px;
    }

    .btn-dark:hover {
        background-color: #444;
        border-color: #444;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 80px;
    }
    
</style>
