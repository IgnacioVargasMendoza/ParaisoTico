<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

    $idUsuario = $_SESSION["IdUsuario"];
    $rolUsuario = $_SESSION["RolUsuario"];
?>

<!DOCTYPE html>
<html lang="es">
<?php printCSS(); ?>

<body id="page-top">

    <?php barraNavegacion(); ?>

    <header class="masthead text-white text-center" style="background-image: url('../Img/playas.jpeg'); background-size: cover; background-position: center ; background-repeat: no-repeat;">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">Mensajes de Contacto</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-envelope"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>
    </header>

    <section class="container my-5">
        <?php
        // Muesta tabla de mensajes solo access para el admin 
        if ($rolUsuario == 'admin') {
          
            $conexion = AbrirBaseDatos();
            $consulta = "SELECT nombre, correo, asunto, mensaje, fecha FROM mensajes ORDER BY fecha DESC";
            $resultado = $conexion->query($consulta);
            ?>

            <div class="text-center mb-4">
                <h3>Mensajes de los Usuarios</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["correo"]; ?></td>
                            <td><?php echo $row["asunto"]; ?></td>
                            <td><?php echo $row["mensaje"]; ?></td>
                            <td><?php echo $row["fecha"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
            CerrarBaseDatos($conexion);
        } else {
            ?>

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

            <?php
        } 
    
        ?>
    </section>
    
    <?php printScript(); ?>

</body>
</html>

