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

<section class="page-section" id="cuenta" style="margin-top: 100px;">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Mi Cuenta</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Información del usuario -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Imagen de perfil -->
                        <img src="<?php echo $usuario['ruta_imagen'] ?? 'app/Views/Img/default-avatar.jpg'; ?>" 
                             class="img-fluid rounded-circle mb-3" 
                             alt="Imagen de perfil" 
                             style="width: 150px; height: 150px; object-fit: cover;">

                        <!-- Nombre del usuario -->
                        <h4 class="card-title"><?php echo $usuario['nombre'] ?? 'Invitado'; ?></h4>

                        <!-- Correo electrónico -->
                        <p class="card-text"><?php echo $usuario['correo'] ?? 'No disponible'; ?></p>

                        <!-- Botones de acción -->
                        <div class="mt-4">
                            <a href="index.php?route=usuario&action=edit&id=<?php echo $usuario['id_usuario']; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar Perfil
                            </a>
                            <a href="index.php?route=usuario&action=changePassword" 
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-lock"></i> Cambiar Contraseña
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean(); // Obtener el contenido del buffer y limpiarlo

// Incluir el layout
include 'View/Layout/layout.php';
?>