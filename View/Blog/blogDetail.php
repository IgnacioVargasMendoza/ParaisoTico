<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/BlogDetailController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: blog.php');
    exit;
}

$blog = obtenerBlogPorId($id);
if (! $blog) {
    echo '<div class="container mt-5"><p class="alert alert-warning">Entrada no encontrada. <a href="blog.php">Volver</a></p></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php printCSS(); ?>
  <link href="../Styles/blogDetail.css" rel="stylesheet" />
</head>
<body id="page-top">
  <?php barraNavegacion(); ?>

  <section class="page-section" id="tourDetail" style="margin-top:100px;">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0">
        <?= htmlspecialchars($blog['titulo']) ?>
      </h2>
      <div class="divider-custom my-4">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
      </div>

      <div class="text-center mb-4">
        <img
          src="<?= htmlspecialchars($blog['imagen_data']) ?>"
          class="img-fluid main-tour-img"
          alt="Imagen principal de <?= htmlspecialchars($blog['titulo']) ?>"
        >
      </div>

      <div class="mt-4">
        <div><?= nl2br(htmlspecialchars($blog['contenido'])) ?></div>
        <h4>Contacto</h4>
        <div><?= nl2br(htmlspecialchars($blog['contacto'])) ?></div>
        <h4>Actividades a realizar</h4>
        <div><?= nl2br(htmlspecialchars($blog['actividades'])) ?></div>
        <h4>En detalle</h4>
        <div><?= nl2br(htmlspecialchars($blog['detallado'])) ?></div>
        <h4>Qué incluye</h4>
        <div><?= nl2br(htmlspecialchars($blog['incluye'])) ?></div>
      </div>

      <div class="mt-4">
        <h5 class="text-center">Galería</h5>
        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php foreach ($chunks as $i => $chunk): ?>
              <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                <div class="row">
                  <?php foreach ($chunk as $img): ?>
                    <div class="col-md-4">
                      <img
                        src="<?= $img ?>"
                        class="d-block w-100"
                        alt="Galería <?= $i + 1 ?>"
                      >
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>

      <div class="mt-4 text-center">
        <a href="blog.php" class="btn btn-secondary">Volver al blog</a>
      </div>
    </div>
  </section>

  <?php printScript(); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../Scripts/modal.js"></script>
</body>
</html>
