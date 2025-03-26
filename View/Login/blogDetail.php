<?php
// Definir el contenido dinámico
ob_start(); // Iniciar el buffer de salida
?>
<?php
// Verificar si la variable $selectedTour está definida
if (!isset($selectedTour)) {
    echo "No se encontró el tour seleccionado.";
    exit;
}
?>
<section class="page-section" id="tourDetail" style="margin-top:100px;">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0"><?php echo $selectedTour['title']; ?></h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="text-center mb-4">
            <img src="<?php echo $mainImagePath; ?>" class="img-fluid main-tour-img" alt="Main Tour Image">
        </div>
        <!-- Extended Tour Details -->
        <div class="mt-4">
            <div><?php echo $selectedTour['content']; ?></div>
            <h4>Contacto</h4>
            <div><?php echo $selectedTour['contact']; ?></div>
            <h4>Actividades a realizar</h4>
            <div><?php echo $selectedTour['activities']; ?></div>
            <h4>En detalle</h4>
            <div><?php echo $selectedTour['detailed']; ?></div>
            <h4>Qué incluye</h4>
            <div><?php echo $selectedTour['includes']; ?></div>
        </div>
        <!-- Gallery Carousel with multiple image cards -->
        <div class="mt-4">
            <h5 class="text-center">Galería</h5>
            <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($chunks as $chunkIndex => $chunk): ?>
                        <div class="carousel-item <?php echo ($chunkIndex == 0 ? 'active' : ''); ?>">
                            <div class="row">
                                <?php foreach ($chunk as $galleryImage): ?>
                                    <div class="col-md-4">
                                        <div class="card gallery-card">
                                            <img src="<?php echo $galleryImage; ?>" class="card-img-top gallery-img" alt="Gallery Image"
                                                 data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="<?php echo $galleryImage; ?>">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="index.php?route=home&action=blog" class="btn btn-secondary">Volver al blog</a>
        </div>
    </div>
</section>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: transparent; border: none;">
            <div class="modal-body p-0">
                <img src="" class="img-fluid" id="modalImage" alt="Full Tour Image">
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean(); // Obtener el contenido del buffer y limpiarlo

// Incluir el layout
include 'View/Layout/layout.php';
?>