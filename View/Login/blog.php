<?php include '../../Controller/BlogController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Paraíso Tico - Blog</title>
       
        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300,400,600,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap) -->
        <link href="../Styles/styles.css" rel="stylesheet" />
        <!-- Blog custom CSS -->
        <link href="../Styles/blog.css" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body id="page-top">
        <!-- Navigation-->
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
                        <li class="nav-item mx-0 mx-lg-1">
                          <a class="nav-link py-3 px-0 px-lg-3 rounded" href="../View/Login/home.php#portfolio">Destinos</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                          <a class="nav-link py-3 px-0 px-lg-3 rounded" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                          <a class="nav-link py-3 px-0 px-lg-3 rounded" href="../View/Login/home.php#contact">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead text-white text-center">
            <div class="container d-flex flex-column align-items-center">
                <h1 class="masthead-heading text-uppercase mb-0">Paraíso Tico Blog</h1>
                <div class="divider-custom divider-light my-3">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <p class="masthead-subheading mb-0">Descubre nuestras experiencias y aventuras</p>
            </div>
        </header>

        <!-- Blog Grid Section -->
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
                        // Loop through tours (loaded in BlogController.php) to create a card for each tour
                        $totalImages = 30; // Total pool of images
                        foreach ($tours as $index => $tour) {
                            $imageIndex = ($index % $totalImages) + 1;
                            $imagePath = "../Img/blog/image_blog_" . $imageIndex . ".jpg";
                            echo '<div class="col-md-6 col-lg-4 mb-4">';
                            echo '  <div class="card h-100">';
                            echo '      <img src="' . $imagePath . '" class="card-img-top" alt="Tour Image">';
                            echo '      <div class="card-body d-flex flex-column">';
                            echo '          <h5 class="card-title">' . $tour['title'] . '</h5>';
                            echo '          <p class="card-text">' . $tour['summary'] . '</p>';
                            echo '          <a href="blogDetail.php?id=' . $tour['id'] . '" class="btn btn-primary">Leer más</a>';
                            echo '      </div>';
                            echo '  </div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>