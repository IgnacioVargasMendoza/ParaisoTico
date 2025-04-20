<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/CategoriaController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
?>

<!DOCTYPE html>
<html>
<?php printCSS(); ?>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php BarraNavegacion(); ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div style="margin-top: 13%;">
                                <div class="text-center">
                                    <h1 class="h1 text-gray-900 mb-4">Elige la categoría de la actividad</h1>
                                </div>

                                <?php
                                if (isset($_POST["Message"])) {
                                    echo '<div class="alert alert-warning Mensajes">' . $_POST["Message"] . '</div>';
                                }
                                ?>

                                <!--Contenedor para mostrar la lista de categorias-->
                                <div class="container">
                                    <div class="row">
                                        <?php
                                            $listaCategorias = consultarCategorias(1);
                                            if (mysqli_num_rows($listaCategorias) > 0) {
                                                $contador = 1;
                                                while ($categoria = mysqli_fetch_array($listaCategorias)) {
                                                    echo '
                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                        <label class="btn btn-outline-secondary w-100 btn-lg">
                                                            <input type="radio" name="opcionesCategoria" id="opcion' . $categoria["id_categorias"] . '
                                                            "class="btn-check" value="' . $categoria["id_categorias"] . '" ' . ($contador == 1 ? 'checked' : '') . '>
                                                            ' . htmlspecialchars($categoria["nombre"]) . '
                                                        </label>
                                                    </div>';
                                                    $contador++;
                                                }
                                            } else {
                                                echo '<div class="col-12"><p class="text-center">No hay categorías disponibles</p></div>';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <!--Modal para agregar nuevas categorias -->
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarCategoria">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <div class="modal fade" id="modalAgregarCategoria" tabindex="-1"
                                    aria-labelledby="modalAgregarCategoria" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalAgregarCategoria">Agregar Nueva
                                                    Categoria</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="txtCategoria">Categoria</label>
                                                        <input type="text" class="form-control" id="txtCategoria" name="txtCategoria" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="btnGuardar"
                                                        name="btnGuardar">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <div class="container-fluid px-5">
            <div class="progress" style="height: 15px;">
                <div id="progressBar" class="progress-bar bg-danger" role="progressbar" style="width: 50%;"
                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4" style="margin-bottom: 1%;">
                <a href="../Login/home.php" class="btn btn-secondary">Atras</a>
                <a href="../Actividades/agregar.php" class="btn btn-primary">Continuar</a>
            </div>
        </div>
    </div>
    <?php PrintScript(); ?>


</body>

</html>