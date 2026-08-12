<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>


<!-- Header-->
<style>
    .text-amarillo {
        color: #e75434;
        font-size: 28px;
        text-align: center;
        font-family: Arial, sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .accordion-button {
        color: #e75434;
        font-weight: bold;
        background-color: #f8f9fa;
        border: none;
        box-shadow: none;
        font-size: 18px;
    }
    .accordion-button:not(.collapsed) {
        color: #212529;
        background-color: #e9ecef;
    }
    .accordion-body {
        font-size: 16px;
        color: #212529;
    }
    .contact-section {
        padding: 20px;
    }
    .form-control {
        border-radius: 0;
        border: 1px solid #ced4da;
    }
    .btn-enviar {
        background-color: #e75434;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        width: 100%;
    }
    .btn-enviar:hover {
        background-color: #cf4a31;
    }
    .footer-text {
        font-size: 14px;
        text-align: center;
        padding: 20px 0;
        color: #666;
    }
</style>

<body>
    
    <div class="container mt-5">
        <!-- Preguntas frecuentes -->
        <h2 class="text-amarillo">Preguntas Frecuentes</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                ¿Cuánto tiempo tarda el envío?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                El envío generalmente tarda entre 3 a 5 días hábiles.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                ¿Puedo devolver un producto?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, las devoluciones están permitidas dentro de los 15 días después de recibir el producto.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                ¿Cómo puedo rastrear mi pedido?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Una vez que tu pedido haya sido enviado, recibirás un correo con el número de rastreo.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                ¿Puedo cancelar mi pedido?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, puedes cancelar tu pedido siempre que no haya sido procesado para el envío.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                ¿Qué métodos de pago aceptan?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Aceptamos tarjetas de crédito, débito y PayPal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                ¿Ofrecen descuentos para compras al por mayor?
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, ofrecemos descuentos para pedidos grandes. Contáctanos para más detalles.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de contacto -->
            <div class="col-md-6 contact-section">
                <h2 class="text-amarillo">¿Tienes alguna duda? ¡Contáctanos!</h2>
                <form action="procesar_dudas.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-enviar">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer-text">
        © 2024 FOCUPUS. Todos los derechos reservados.
    </div>



</body>

<?php 
include 'templates/pie.php';
?>