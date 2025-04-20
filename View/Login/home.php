<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";

?>

<!DOCTYPE html>
<html lang="es">

    <?php printCSS(); ?>

    <body id="page-top">

        <?php barraNavegacion() ?>

        <header class="masthead text-white text-center" style="background-image: url('../Img/sol.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container d-flex align-items-center flex-column">
                <h1 class="masthead-heading text-uppercase mb-0">Paraíso Tico</h1>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <p class="masthead-subheading font-weight-light mb-0">Donde la tranquilidad es Pura Vida</p>
            </div>
        </header>

        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Destinos</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <!-- Heredia -->
                    <div class="col-md-6 col-lg-4 mb-5">
                    <a href="../actividades/listado.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Heredia</div>
                            </div>
                            <img class="img-fluid" src="../Img/barco.jpeg" alt="Heredia" />
                        </a>
                    </div>
                    <!-- Limon -->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="limon.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Limon</div>
                            </div>
                            <img class="img-fluid" src="../Img/arena.jpeg" alt="Limon" />
                        </a>
                    </div>
                    <!-- Alajuela -->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="alajuela.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Alajuela</div>
                            </div>
                            <img class="img-fluid" src="../Img/volcan.jpg" alt="Alajuela" />
                        </a>
                    </div>
                    <!-- Puntarenas -->
                    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <a href="puntarenas.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Puntarenas</div>
                            </div>
                            <img class="img-fluid" src="../Img/playas.jpeg" alt="Puntarenas" />
                        </a>
                    </div>
                    <!-- Grecia -->
                    <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                        <a href="grecia.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Grecia</div>
                            </div>
                            <img class="img-fluid" src="../Img/grecia.jpeg" alt="Grecia" />
                        </a>
                    </div>
                    <!-- Cartago -->
                    <div class="col-md-6 col-lg-4">
                        <a href="cartago.php" class="portfolio-item mx-auto text-decoration-none">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white fs-3 fw-bold">Cartago</div>
                            </div>
                            <img class="img-fluid" src="../Img/colibri.webp" alt="Cartago" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php printScript(); ?>

    </body>
</html>
