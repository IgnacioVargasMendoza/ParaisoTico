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
// Iniciar el buffer de salida
ob_start();
?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
<section class="page-section" id="reservacion">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Reservación</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Formulario de reservación -->
        <form action="index.php?route=reservacion&action=store" method="POST">
            <!-- Campo para seleccionar la actividad -->
            <label for="id_actividad">Actividad</label>
            <div class="mb-2">
                <select class="form-select" id="id_actividad" name="id_actividad" required>
                    <option value="">Seleccione una actividad</option>
                    <?php foreach ($actividades as $actividad): ?>
                        <option value="<?php echo $actividad->id_actividad; ?>">
                            <?php echo htmlspecialchars($actividad->nombre); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="id_usuario" id="" value="<?php echo $usuario['id_usuario']; ?>">
            </div>

            <!-- Campo para seleccionar la oferta (opcional) -->
            <div class="mb-2">
                <label for="id_oferta">Oferta</label>
                <select class="form-select" id="id_oferta" name="id_oferta">
                    <option value="">Seleccione una oferta (opcional)</option>
                    <?php foreach ($ofertas as $oferta): ?>
                        <option value="<?php echo $oferta->id_oferta; ?>">
                            <?php echo htmlspecialchars($oferta->descripcion); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Campo para la fecha de reserva -->
            <div class="form-floating mb-2">
                <input type="datetime-local" class="form-control" id="fecha_reserva"  name="fecha_reserva" required>
                <label for="fecha_reserva">Fecha de reserva</label>
            </div>

            <!-- Campo para la fecha de la actividad -->
            <div class="form-floating mb-2">
                <input type="datetime-local" class="form-control" id="fecha_actividad" min="<?= date('Y-m-d\TH:i') ?>" name="fecha_actividad" required>
                <label for="fecha_actividad">Fecha de la actividad</label>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Reservar</button>
            </div>
        </form>
    </div>
</section>
<?php
// Obtener el contenido del buffer y limpiarlo
$content = ob_get_clean();

// Incluir el layout
include 'View/Layout/layout.php';
?>