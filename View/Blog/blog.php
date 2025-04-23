<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/BlogController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
$blogs = obtenerBlogs();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Paraíso Tico - Blog</title>
       
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../Styles/bootstrap.min.css" rel="stylesheet"/>
        <link href="../Styles/styles.css" rel="stylesheet" />

        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../Styles/blog.css">
    </head>
    <body id="page-top">
        <?php barraNavegacion(); ?>

        <!-- Masthead -->
        <header class="masthead text-white text-center" style="background-image: url('../Img/sol.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container d-flex align-items-center flex-column">
                <h1 class="masthead-heading text-uppercase mb-0">Paraíso Tico</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Donde la tranquilidad es Pura Vida</p>
            </div>
        </header>

        <!-- Sección de Blog -->
        <section class="page-section" id="blog">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Blog</h2>
                <div class="divider-custom my-4">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
        
                <!-- Botón para abrir el modal de crear blog -->
                <div class="container my-4 text-center">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#crearBlogModal">
                        Crear nuevo Blog
                    </button>
                </div>

                <div class="row">
                    <?php foreach ($blogs as $index => $blog): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <?php if (!empty($blog['imagen_data'])): ?>
                                    <img src="<?php echo $blog['imagen_data']; ?>" class="card-img-top" alt="Imagen del blog">
                                <?php else: ?>
                                    <img src="../Img/default.jpg" class="card-img-top" alt="Imagen por defecto">
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo $blog['titulo']; ?></h5>
                                    <p class="card-text"><?php echo $blog['resumen']; ?></p>
                                    <div class="d-flex align-items-center justify-content-center mt-auto">
                                        <a href="blogDetail.php?id=<?php echo $blog['id_blog']; ?>" class="btn btn-secondary w-100 me-2">Leer más</a>
                                        <a href="/ParaisoTico/Controller/BlogController.php?accion=eliminar&id_blog=<?php echo $blog['id_blog']; ?>" class="btn btn-danger w-100" onclick="return confirm('¿Estás seguro de eliminar este blog?');">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Modal para crear nuevo Blog -->
        <div class="modal fade" id="crearBlogModal" tabindex="-1" aria-labelledby="crearBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearBlogModalLabel">Crear Nuevo Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Si existe un error (por ejemplo, recibido como parámetro GET) se muestra alerta -->
                        <?php if(isset($_GET['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php endif; ?>
                        <form id="formCrearBlog" action="../../Controller/BlogController.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="resumen" class="form-label">Resumen</label>
                                <textarea class="form-control" id="resumen" name="resumen" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="contenido" class="form-label">Contenido</label>
                                <textarea class="form-control" id="contenido" name="contenido" rows="6" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="contacto" class="form-label">Contacto</label>
                                <textarea class="form-control" id="contacto" rows="3" name="contacto" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="actividades" class="form-label">Actividades a realizar</label>
                                <textarea class="form-control" id="actividades" name="actividades" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="detallado" class="form-label">En detalle</label>
                                <textarea class="form-control" id="detallado" name="detallado" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="incluye" class="form-label">Qué incluye</label>
                                <textarea class="form-control" id="incluye" name="incluye" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen principal</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="imagenes_blog" class="form-label">Imágenes de la galería</label>
                                <input type="file" class="form-control" id="imagenes_blog" name="imagenes_blog[]" accept="image/*" multiple>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Crear Blog</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php printScript(); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>