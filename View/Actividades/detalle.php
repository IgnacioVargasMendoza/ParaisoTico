<?php
// File: /ParaisoTico/View/Actividades/detalle.php

include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ActividadesController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ReservasController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$detalleActividad = consultarActividadPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php printCSS(); ?>
</head>
<body id="page-top">
    <?php barraNavegacion(); ?>

    <!-- Mensajes de feedback tras intento de reserva -->
    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <section class="page-section" id="actividadDetalle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <img src="../Img/playa.jpg" class="card-img-top" alt="Imagen de la Actividad">
                        <div class="card-body">
                            <h5 class="card-title">
                                Actividad: <?= htmlspecialchars($detalleActividad["nombre_categoria"]) ?>
                            </h5>
                            <p class="card-text">
                                <strong>Descripción:</strong><br>
                                <?= nl2br(htmlspecialchars($detalleActividad["descripcion"])) ?>
                            </p>
                            <p class="card-text">
                                <strong>Incluye:</strong><br>
                                <?= nl2br(htmlspecialchars($detalleActividad["descripcion_incluye"])) ?>
                            </p>

                            <!-- FORMULARIO DE RESERVA -->
                            <form action="/ParaisoTico/Controller/ReservasController.php" method="post" class="mt-4">
                                <input type="hidden" name="id_actividad" value="<?= $id ?>">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nombre_cliente" class="form-label">Nombre completo</label>
                                        <input type="text" name="nombre_cliente" id="nombre_cliente"
                                               class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" name="email" id="email"
                                               class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
                                        <input type="date" name="fecha_reserva" id="fecha_reserva"
                                               class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="num_personas" class="form-label">Número de personas</label>
                                    <input type="number" name="num_personas" id="num_personas"
                                           class="form-control" min="1" value="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="comentarios" class="form-label">Comentarios</label>
                                    <textarea name="comentarios" id="comentarios"
                                              class="form-control" rows="2"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Reservar Actividad</button>
                            </form>
                            <!-- FIN FORMULARIO -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- Resto de secciones idéntico al original -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Valoraciones</h3>
                    <div class="rating">
                        <span>⭐⭐⭐⭐⭐</span>
                        <p>(5 de 5, basado en 120 valoraciones)</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Galería de la Actividad</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../Img/colibri.webp" class="img-fluid mb-3" alt="Imagen 1">
                        </div>
                        <div class="col-md-4">
                            <img src="../Img/sol.jpeg" class="img-fluid mb-3" alt="Imagen 2">
                        </div>
                        <div class="col-md-4">
                            <img src="../Img/volcan.jpg" class="img-fluid mb-3" alt="Imagen 3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Información Adicional</h3>
                    <ul>
                        <li><strong>Ubicación:</strong> <?= htmlspecialchars($detalleActividad["nombre_provincia"]) ?>, Costa Rica</li>
                        <li><strong>Punto Encuentro:</strong> <?= htmlspecialchars($detalleActividad["punto_encuentro"]) ?></li>
                        <li><strong>Horario:</strong> 9:00 AM - 12:00 PM</li>
                        <li><strong>Precio:</strong> <?= htmlspecialchars($detalleActividad["precio"]) ?> por persona</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php printScript(); ?>
</body>
</html>
