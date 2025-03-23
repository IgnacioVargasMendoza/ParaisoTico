<?php include '../../Controller/BlogDetailController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $tour['title']; ?> - Paraíso Tico</title>
       
        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Core theme CSS and Bootstrap -->
        <link href="../Styles/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Styles/blogDetail.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="home.php">Paraíso Tico</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" 
                        data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    Menu <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../View/Login/home.php#portfolio">Destinos</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="blog.php">Blog</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../View/Login/home.php#contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <section class="page-section" id="tourDetail" style="margin-top:100px;">
            <div class="container">
                <h2 class="text-center text-uppercase text-secondary mb-0"><?php echo $tour['title']; ?></h2>
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
                    <div><?php echo $tour['content']; ?></div>
                    <h4>Contacto</h4>
                    <div><?php echo $tour['contact']; ?></div>
                    <h4>Actividades a realizar</h4>
                    <div><?php echo $tour['activities']; ?></div>
                    <h4>En detalle</h4>
                    <div><?php echo $tour['detailed']; ?></div>
                    <h4>Qué incluye</h4>
                    <div><?php echo $tour['includes']; ?></div>
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
                    <a href="blog.php" class="btn btn-secondary">Volver al blog</a>
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
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../Scripts/modal.js"></script>
    </body>
</html>