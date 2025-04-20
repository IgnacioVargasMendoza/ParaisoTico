<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/BlogController.php";

?>

<!DOCTYPE html>
<html lang="en">

    <?php printCSS(); ?>
    <link href="../Styles/blog.css" rel="stylesheet" />

    <body id="page-top">
        
        <?php barraNavegacion() ?>

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
        <?php printScript(); ?>
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>