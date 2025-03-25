<?php
// Definir el contenido dinámico
ob_start(); // Iniciar el buffer de salida
?>
<section class="page-section" id="blog">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tours</h2>
        <div class="divider-custom my-4">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <?php
            if (!isset($tours)) {
                echo "La variable \$tours no está definida.";
                exit;
            }
            ?>

            <?php if (!empty($tours)): ?>
                <?php foreach ($tours as $tour): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo $tour['imagePath']; ?>" class="card-img-top" alt="Tour Image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $tour['title']; ?></h5>
                                <p class="card-text"><?php echo $tour['summary']; ?></p>
                                <a href="index.php?route=home&action=blogDetail&id=<?php echo $tour['id']; ?>" class="btn btn-primary">Leer más</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay tours disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean(); // Obtener el contenido del buffer y limpiarlo

// Incluir el layout
include 'View/Layout/layout.php';
?>