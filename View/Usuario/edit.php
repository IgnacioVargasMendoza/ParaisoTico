<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?route=login&action=login');
    exit;
}

?>

<?php

ob_start(); 
?>

<section class="page-section" id="editarPerfil" style="margin-top: 100px;">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Editar Perfil</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="index.php?route=usuario&action=update&id=<?php echo $usuario->id_usuario; ?>" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group mb-3">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?php echo $usuario->username; ?>" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="<?php echo $usuario->nombre; ?>" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="primer_apellido">Primer apellido</label>
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" 
                               value="<?php echo $usuario->primer_apellido; ?>" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" 
                               value="<?php echo $usuario->correo; ?>" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" 
                               value="<?php echo $usuario->telefono; ?>">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="ruta_imagen">Imagen de perfil</label>
                        <input type="file" class="form-control" id="ruta_imagen" name="ruta_imagen">
                        <?php if (!empty($usuario->ruta_imagen)): ?>
                            <small class="form-text text-muted">
                                Imagen actual: <a href="<?php echo $usuario->ruta_imagen; ?>" target="_blank">Ver imagen</a>
                            </small>
                        <?php endif; ?>
                    </div>

                    
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
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