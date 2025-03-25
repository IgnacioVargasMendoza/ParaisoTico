<?php
ob_start();
?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<section class="page-section" id="mis-reservaciones">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Mis Reservaciones</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <?php if (empty($reservaciones)): ?>
            <div class="alert alert-info text-center">
                No tienes reservaciones registradas.
                <a href="index.php?route=reservacion&action=reservar" class="alert-link">Haz una reservación ahora</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservaciones as $reserva): ?>
                            <?php 
                            $actividad = Actividad::find($reserva->id_actividad);
                            $oferta = $reserva->id_oferta ? Oferta::find($reserva->id_oferta) : null;
                            ?>
                            <tr>
                                <td><?php echo $reserva->id_reserva; ?></td>
                                <td>
                                    <?php echo htmlspecialchars($actividad->nombre); ?>
                                    <?php if ($oferta): ?>
                                        <span class="badge bg-success ms-2">Oferta: <?php echo htmlspecialchars($oferta->descripcion); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d M Y H:i', strtotime($reserva->fecha_actividad)); ?></td>
                                <td>$<?php echo number_format($reserva->total, 2); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($reserva->activo == 1) ? 'success' : 'warning'; ?>">
                                        <?php echo ($reserva->activo == 1) ? 'Confirmada' : 'Pendiente'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?route=reservacion&action=show&id=<?php echo $reserva->id_reserva; ?>" 
                                       class="btn btn-sm btn-outline-primary me-2"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if ($reserva->activo != 1): ?>
                                        <a href="#" class="btn btn-sm btn-outline-danger"
                                           title="Cancelar reserva">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'View/Layout/layout.php';
?>