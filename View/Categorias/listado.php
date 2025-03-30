<?php
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
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Some text inside the first card</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Some text inside the second card</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Some text inside the third card</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Some text inside the fourth card</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
                                    <i class="fas fa-plus"></i> 
                                    </button>
                                    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoria" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalAgregarCategoria">Agregar Nueva Categoria</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="txtCategoria">Categoria</label>
                                                <input type="text" class="form-control" id="txtCategoria" name="txtCategoria">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Guardar</button>
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
        </div>
        <div class="fixed-bottom">
            <div class="container-fluid px-5">
                <div class="progress" style="height: 15px;">
                    <div id="progressBar" class="progress-bar bg-danger" role="progressbar"
                         style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4" style="margin-bottom: 1%;">
                <a href="../Actividades/listado.php" class="btn btn-secondary">Atras</a>
                    <a href="../Actividades/agregar.php" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div>
        <?php PrintScript(); ?>


    </body>
</html>
