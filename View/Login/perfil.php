<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>


<!DOCTYPE html>
<html lang="es">
<?php printCSS(); ?>
<link rel="stylesheet" href="../Styles/perfil.css">

<body id="page-top">

    <?php barraNavegacion(); ?>

    <header class="masthead text-white text-center" style="background-image: url('../Img/conchas.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">Mi Perfil</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-user"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg rounded-4 p-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Información de Usuario</h5>
                        
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" id="nombre" name="nombre" value="<?php echo $_SESSION["NombreUsuario"]; ?>" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control rounded-3 shadow-sm" id="correo" name="correo" value="<?php echo $_SESSION["CorreoUsuario"]; ?>" disabled>
                        </div>

                       

                        <?php
                            if (isset($_SESSION["Message"])) {
                                echo "<div class='alert alert-info mt-3'>" . $_SESSION["Message"] . "</div>";
                                unset($_SESSION["Message"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
