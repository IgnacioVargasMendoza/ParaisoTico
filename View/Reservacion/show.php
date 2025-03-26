<?php
ob_start();
?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<section class="page-section" id="detalle-reserva">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Detalle de Reservación</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Tarjeta con los detalles de la reserva -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Reserva #<?php echo htmlspecialchars($reserva->id_reserva); ?></h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Estado:</h6>
                        <span class="badge bg-<?php echo ($reserva->activo == 1) ? 'success' : 'warning'; ?>">
                            <?php echo ($reserva->activo == 1) ? 'Confirmada' : 'Pendiente'; ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Total:</h6>
                        <p>$<?php echo number_format($reserva->total, 2); ?></p>
                    </div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Actividad:</h6>
                        <p><?php echo htmlspecialchars($actividad->nombre); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Oferta aplicada:</h6>
                        <p><?php echo !empty($oferta) ? htmlspecialchars($oferta->descripcion) : 'Ninguna'; ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha de Reserva:</h6>
                        <p><?php echo date('d/m/Y H:i', strtotime($reserva->fecha_reserva)); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha de Actividad:</h6>
                        <p><?php echo date('d/m/Y H:i', strtotime($reserva->fecha_actividad)); ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Reservado por:</h6>
                        <p><?php echo htmlspecialchars($usuario->nombre . ' ' . $usuario->primer_apellido); ?></p>
                        <?php if (!empty($usuario->correo)): ?>
                            <h6 class="text-muted mt-2">Correo:</h6>
                            <p><?php echo htmlspecialchars($usuario->correo); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($usuario->telefono)): ?>
                            <h6 class="text-muted mt-2">Teléfono:</h6>
                            <p><?php echo htmlspecialchars($usuario->telefono); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="index.php?route=reservacion" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
                <button class="btn btn-success ms-2" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Imprimir
                </button>
            </div>
        </div>
    </div>
</section>

<script>
function imprimirReserva() {
    window.print();
}
</script>

<?php
$content = ob_get_clean();
include 'View/Layout/layout.php';
?>