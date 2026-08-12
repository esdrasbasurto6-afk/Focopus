<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>FOCOPUS</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts (fuente más estética) -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@600&display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="Garet-Book.ttf">
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <style>
        /* Estilos para la navegación */
        .navbar-nav .nav-link {
            font-weight: normal;
            color: #212529; /* Texto en negro */
            font-family: 'Poppins', sans-serif; /* Tipografía más moderna y estilizada */
            font-size: 18px; /* Tamaño de fuente más grande */
            padding: 12px 30px; /* Alineación y espaciado similar */
            text-decoration: none; /* Evitar subrayado */
            background-color: #d8a40c; /* Fondo amarillo como el navbar */
            border: 2px solid transparent; /* Borde invisible por defecto */
            transition: background-color 0.3s ease, color 0.3s ease, border 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: #ff5733; /* Fondo al pasar el mouse */
            color: white; /* Texto en blanco al hacer hover */
        }

        .navbar-nav .nav-link.active {
            font-weight: bold;
            color: white; /* Texto blanco cuando está activo */
            background-color: #212529; /* Fondo oscuro cuando está activo */
            border: 2px solid #212529; /* Borde negro cuando está activo */
        }

        /* Quitar el borde del botón Dudas y hacerlo consistente con los demás botones */
        .btn-dudas {
            display: none; /* Ocultar el botón específico de "DUDAS", ya que lo manejamos con el enlace nav-link */
        }

        .cart-count {
            position: relative;
            top: -10px;
            left: -10px;
        }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-amarillo">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"><img src="FocopusLogoNegro.png" alt="Icono"> FOCOPUS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'hombre.php') ? 'active' : ''; ?>" href="hombre.php">HOMBRES</a></li>
                    <li><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'mujer.php') ? 'active' : ''; ?>" href="mujer.php">MUJERES</a></li>
                    <li><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dudas.php') ? 'active' : ''; ?>" href="dudas.php">DUDAS</a></li>
                </ul>
                <form action="showcart.php" class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        <span class="navbar-brand">Carrito (<?php echo(empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>)</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <script>
     
    </script>
</body>
</html>
