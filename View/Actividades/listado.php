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

        <header class="masthead text-white text-center" style="background-image: url('../Img/actividades3.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container d-flex align-items-center flex-column">
                <h1 class="masthead-heading text-uppercase mb-0"> Actividades</h1>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
        </header>

        <section class="page-section portfolio" id="infoCuadros">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card text-center h-100 shadow">
                            <img src="../Img/playa.jpg" class="card-img-top" alt="Actividad 1">
                            <div class="card-body">
                                <h5 class="card-title">Actividad 1</h5>
                                <p class="card-text"> actividad 1.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card text-center h-100 shadow">
                            <img src="../Img/playa.jpg" class="card-img-top" alt="Actividad 2">
                            <div class="card-body">
                                <h5 class="card-title">Actividad 2</h5>
                                <p class="card-text">actividad 2.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card text-center h-100 shadow">
                            <img src="../Img/playa.jpg" class="card-img-top" alt="Actividad 3">
                            <div class="card-body">
                                <h5 class="card-title">Actividad 3</h5>
                                <p class="card-text"> actividad 3.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php printScript(); ?>

    </body>
</html>