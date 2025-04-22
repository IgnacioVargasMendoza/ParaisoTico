<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

    $idUsuarioEditar = $_GET['id'];
    $conexion = AbrirBaseDatos();

    $consulta = $conexion->prepare("SELECT id_usuario, nombre, correo, rol FROM usuario WHERE id_usuario = ?");
    $consulta->bind_param("i", $idUsuarioEditar);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $usuario = $resultado->fetch_assoc();

    CerrarBaseDatos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<?php printCSS(); ?>

<body id="page-top">
    <?php barraNavegacion(); ?>

    <header class="masthead text-white text-center" style="background-image: url('../Img/editar5.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 450px;">
        <div class="container d-flex align-items-center flex-column" style="padding-top: 80px;">
            <h1 class="masthead-heading text-uppercase mb-0">Editar Usuario</h1>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-user-edit"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>
    </header>


    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg rounded-4 p-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Editar Usuario</h5>

                        <form action="../../Model/ActualizarPerfilModel.php" method="POST">
                            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                            <div class="form-group mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control rounded-3 shadow-sm" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" id="rol" name="rol" value="<?php echo $usuario['rol']; ?>" required>
                            </div>

                            <div class="text-center">
                            <button type="submit" class="btn text-white" style="background-color: #006666;">Guardar Cambios</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php printScript(); ?>

</body>
</html>
