<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?route=login&action=login');
    exit;
}

// Obtener los datos del usuario desde la sesión
$usuario = $_SESSION['usuario'];
?>

<?php
// Definir el contenido dinámico
ob_start(); // Iniciar el buffer de salida
?>

<section class="page-section" id="cambiarContraseña" style="margin-top: 100px;">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Cambiar Contraseña</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Formulario para cambiar la contraseña -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="index.php?route=usuario&action=updatePassword&id=<?php echo $usuario['id_usuario']; ?>" method="POST">
                    <!-- Campo: Contraseña actual -->
                    <div class="form-group mb-3">
                        <label for="current_password">Contraseña actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>

                    <!-- Campo: Nueva contraseña -->
                    <div class="form-group mb-3">
                        <label for="new_password">Nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>

                    <!-- Campo: Confirmar nueva contraseña -->
                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>

                    <!-- Botón de envío -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                        <a href="index.php?route=home&action=cuenta" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean(); // Obtener el contenido del buffer y limpiarlo

// Incluir el layout
include 'View/Layout/layout.php';
?>