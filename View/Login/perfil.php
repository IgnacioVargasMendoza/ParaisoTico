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
        <?php
        if ($rolUsuario == 'admin') {
            $conexion = AbrirBaseDatos();
            $consulta = "SELECT id_usuario, nombre, correo, rol FROM usuario";
            $resultado = $conexion->query($consulta);
            ?>
            
            <div class="text-center mb-4">
                <h3>Lista de Usuarios</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["correo"]; ?></td>
                            <td><?php echo ucfirst($row["rol"]); ?></td>
                            <td>
                            <a href="editarUsuario.php?id=<?php echo $row["id_usuario"]; ?>" class="btn btn-warning" style="background-color: rgb(68, 122, 158); border-color: rgb(68, 122, 158);">Editar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <?php
            CerrarBaseDatos($conexion);
        } else {
            $conexion = AbrirBaseDatos();
            $consulta = $conexion->prepare("SELECT id_usuario, nombre, correo, rol FROM usuario WHERE id_usuario = ?");
            $consulta->bind_param("i", $idUsuario);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $usuario = $resultado->fetch_assoc();
            CerrarBaseDatos($conexion);
            ?>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg rounded-4 p-4">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">Información de Usuario</h5>
                            
                            <form action="../Model/ActualizarPerfilModel.php" method="POST">
                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                                <div class="form-group mb-3">
                                    <label for="nombre" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control rounded-3 shadow-sm" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required <?php echo ($rolUsuario == 'admin') ? '' : 'disabled'; ?>>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="correo" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control rounded-3 shadow-sm" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required <?php echo ($rolUsuario == 'admin') ? '' : 'disabled'; ?>>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="rol" class="form-label">Rol</label>
                                    <input type="text" class="form-control rounded-3 shadow-sm" id="rol" name="rol" value="<?php echo ucfirst($usuario['rol']); ?>" disabled>
                                </div>

                                <?php
                                    if (isset($_SESSION["Message"])) {
                                        echo "<div class='alert alert-info mt-3'>" . $_SESSION["Message"] . "</div>";
                                        unset($_SESSION["Message"]);
                                    }
                                ?>

                                <?php if ($_SESSION["RolUsuario"] == 'admin'): ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                <?php endif; ?>
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
