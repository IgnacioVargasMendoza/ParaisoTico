<?php 
include_once '../../Controller/BlogDetailController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $blog['titulo']; ?> - Paraíso Tico</title>
       
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="../Styles/styles.css" rel="stylesheet" />

        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="../Styles/blogDetail.css" rel="stylesheet" />
    </head>
    
    <body>

        <?php barraNavegacion() ?>

        <section class="page-section" id="tourDetail" style="margin-top:100px;">
            <div class="container">
                <!-- Título del blog -->
                <h2 class="text-center text-uppercase text-secondary mb-0"><?php echo $blog['titulo']; ?></h2>
                <div class="divider-custom my-4">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Imagen principal -->
                <div class="text-center mb-4">
                    <img src="<?php echo $blog['imagen_data']; ?>" class="img-fluid main-tour-img" alt="Imagen principal del blog">
                </div>
                <!-- Detalles extendidos del blog -->
                <div class="mt-4">
                    <div><?php echo $blog['contenido']; ?></div>
                    <h4>Contacto</h4>
                    <div><?php echo $blog['contacto']; ?></div>
                    <h4>Actividades a realizar</h4>
                    <div><?php echo $blog['actividades']; ?></div>
                    <h4>En detalle</h4>
                    <div><?php echo $blog['detallado']; ?></div>
                    <h4>Qué incluye</h4>
                    <div><?php echo $blog['incluye']; ?></div>
                </div>
                <!-- Carrusel de la galería -->
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
                                                    <img src="<?php echo $galleryImage; ?>" class="card-img-top gallery-img" alt="Imagen de la galería"
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
                <!-- Volver al blog -->
                <div class="mt-4 text-center">
                    <a href="blog.php" class="btn btn-secondary">Volver al blog</a>
                </div>
            </div>
        </section>
    
        <!-- Modal para la imagen de la galería -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: transparent; border: none;">
                    <div class="modal-body p-0">
                        <img src="" class="img-fluid" id="modalImage" alt="Imagen completa del blog">
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../Scripts/modal.js"></script>
    </body>
</html>