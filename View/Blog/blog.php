<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/BlogController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";

$blogs = obtenerBlogs();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php printCSS(); ?>
    <link rel="stylesheet" href="../Styles/blog.css">
</head>

<body id="page-top">
    <?php barraNavegacion(); ?>

    <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <header class="masthead text-white text-center" style="
        background-image: url('../Img/sol.jpeg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">Paraíso Tico</h1>
            <div class="divider-custom divider-light mb-4">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <p class="masthead-subheading font-weight-light mb-0">Donde la tranquilidad es Pura Vida</p>
        </div>
    </header>

    <section class="page-section" id="blog">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-4">Blog</h2>
            <div class="text-center mb-4">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#crearBlogModal">
                    Crear nuevo Blog
                </button>
            </div>

            <div class="row">
                <?php foreach ($blogs as $blog): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($blog['imagen_data'])): ?>
                        <img src="<?= $blog['imagen_data'] ?>" class="card-img-top" alt="Imagen del blog">
                        <?php else: ?>
                        <img src="../Img/default.jpg" class="card-img-top" alt="Imagen por defecto">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($blog['titulo']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($blog['resumen']) ?></p>
                            <div class="mt-auto">
                                <div class="mt-auto">
                                    <a href="blogDetail.php?id=<?= $blog['id_blog'] ?>"
                                        class="btn btn-secondary w-100 mb-2">
                                        Leer más
                                    </a>
                                </div>
                                <div class="mt-auto">

                                    <a href="/ParaisoTico/Controller/BlogController.php?accion=eliminar&id_blog=<?= $blog['id_blog'] ?>"
                                        class="btn btn-danger w-100"
                                        onclick="return confirm('¿Estás seguro de eliminar este blog?');">
                                        Eliminar
                                    </a>
                                </div>
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
                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                    <?php endif; ?>
                    <form id="formCrearBlog" action="/ParaisoTico/Controller/BlogController.php" method="post"
                        enctype="multipart/form-data">
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
                            <textarea class="form-control" id="contacto" name="contacto" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="actividades" class="form-label">Actividades a realizar</label>
                            <textarea class="form-control" id="actividades" name="actividades" rows="3"
                                required></textarea>
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
                            <input type="file" class="form-control" id="imagenes_blog" name="imagenes_blog[]"
                                accept="image/*" multiple>
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