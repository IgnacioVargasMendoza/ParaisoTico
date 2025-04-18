<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<?php printCSS(); ?>
<link rel="stylesheet" href="../Styles/contacto.css">

<body id="page-top">

    <?php barraNavegacion(); ?>

    <header class="masthead text-white text-center" style="background-image: url('../Img/contacto.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">Contáctenos</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-envelope"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <p class="masthead-subheading font-weight-light mb-0">¿Tienes dudas o comentarios? ¡Escríbenos!</p>
        </div>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg rounded-4 p-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Formulario de contacto</h5>
                        <form action="../../Controller/ContactoController.php" method="POST">
                            
                            <div class="form-group mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" id="nombre" name="nombre" placeholder="Nombre completo" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control rounded-3 shadow-sm" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="asunto" class="form-label">Asunto</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" id="asunto" name="asunto" placeholder="Asunto del mensaje" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea class="form-control rounded-3 shadow-sm" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                            </div>

                            <?php
                                if (isset($_SESSION["MensajeContacto"])) {
                                    echo "<div class='alert alert-info mt-3'>" . $_SESSION["MensajeContacto"] . "</div>";
                                    unset($_SESSION["MensajeContacto"]);
                                }
                            ?>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar mensaje
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
