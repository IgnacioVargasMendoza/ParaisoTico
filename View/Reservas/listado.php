<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ReservasController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";

$reservas = listarReservas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php printCSS(); ?>
</head>
< id="page-top">
    <?php barraNavegacion(); ?>

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6" style="margin-top:2%;">

                            <section class="page-section" id="reservas">
                                <div class="container">
                                    <h2 class="text-center text-uppercase text-secondary mb-4">Reservas</h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Actividad</th>
                                                    <th>Cliente</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                    <th>Fecha Reserva</th>
                                                    <th>Personas</th>
                                                    <th>Estado</th>
                                                    <th>Creado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($reservas as $row): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['id_reserva']) ?></td>
                                                    <td><?= htmlspecialchars($row['actividad']) ?></td>
                                                    <td><?= htmlspecialchars($row['nombre_cliente']) ?></td>
                                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                                    <td><?= htmlspecialchars($row['telefono']) ?></td>
                                                    <td><?= htmlspecialchars($row['fecha_reserva']) ?></td>
                                                    <td><?= htmlspecialchars($row['num_personas']) ?></td>
                                                    <td><?= htmlspecialchars($row['estado']) ?></td>
                                                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php printScript(); ?>
    </body>

</html>