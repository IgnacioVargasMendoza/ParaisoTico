<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ActividadesController.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$listaActividades = consultarActividadesActivas();
?>

<!DOCTYPE html>
<html lang="es">
<?php printCSS(); ?>

<body id="page-top">
    <?php barraNavegacion(); ?>

    <header class="masthead text-white text-center" style="
        background-image: url('../Img/actividades3.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">Actividades</h1>
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

                <?php if ($listaActividades === null): ?>
                    <div class="col-12 text-center text-danger">
                        Error al consultar actividades.
                    </div>

                <?php elseif ($listaActividades && mysqli_num_rows($listaActividades) > 0): ?>

                    <?php while ($act = mysqli_fetch_assoc($listaActividades)): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card text-center h-100 shadow">
                                <img
                                  src="../Img/playa.jpg"
                                  class="card-img-top"
                                  alt="<?= htmlspecialchars($act['nombre']) ?>"
                                >
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($act['nombre']) ?></h5>
                                    <a href="detalle.php?id=<?= $act['id_actividad'] ?>" class="btn btn-primary">
                                      Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">No hay actividades activas disponibles.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php printScript(); ?>
</body>
</html>
