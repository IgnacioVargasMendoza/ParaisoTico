<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="es">

    <?php printCSS(); ?>

    <body id="page-top">

        <?php barraNavegacion() ?>
                <div class="divider-custom divider-light">
                </div>
            </div>
        </header>

        <section class="page-section" id="actividadDetalle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <img src="../Img/playa.jpg" class="card-img-top" alt="Imagen de la Actividad">
                            <div class="card-body">
                                <h5 class="card-title">Actividad 1: Playa y Aventura</h5>
                                <p class="card-text">holissss descripcion aqui</p>
                                <p class="card-text">poner mas texto</p>
                                <a href="reserva.php" class="btn btn-primary">Reservar Actividad</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3>Valoraciones</h3>
                        <div class="rating">
                            <span>⭐⭐⭐⭐⭐</span>
                            <p>(5 de 5, basado en 120 valoraciones)</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3>Galería de la Actividad</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="../Img/colibri.webp" class="img-fluid mb-3" alt="Imagen 1">
                            </div>
                            <div class="col-md-4">
                                <img src="../Img/sol.jpeg" class="img-fluid mb-3" alt="Imagen 2">
                            </div>
                            <div class="col-md-4">
                                <img src="../Img/volcan.jpg" class="img-fluid mb-3" alt="Imagen 3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3>Información Adicional</h3>
                        <ul>
                            <li><strong>Ubicación:</strong> Playa de Punta Uva, Puerto Viejo, Costa Rica</li>
                            <li><strong>Duración:</strong> 3 horas</li>
                            <li><strong>Horario:</strong> 9:00 AM - 12:00 PM</li>
                            <li><strong>Precio:</strong> $50 por persona</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php printScript(); ?>

    </body>
</html>

