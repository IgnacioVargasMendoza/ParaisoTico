<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/CategoriaController.php";
?>

<!DOCTYPE html>
<html>
    <?php printCSS(); ?>
    <?php BarraNavegacion(); ?>

        <body id="page-top">
            <div id="wrapper">
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        <div class="container-fluid">
                             <div class="row">
                                <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <hr>
                                        <hr>
                                        <hr>
                                        <hr>
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Crear Actividad</h1>
                                        </div>

                                        <?php
                                            if(isset($_POST["Message"]))
                                            {
                                                echo '<div class="alert alert-warning Mensajes">' . $_POST["Message"] . '</div>';                                   
                                            }
                                        ?>

                                        <form action="" method="POST"> 
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="txtNombre">Nombre</label>
                                                    <input type="text" class="form-control is-valid" id="txtNombre" name="txtNombre" placeholder="Nombre de la Actividad" required>
                                            </div>

                                            <input type="submit" class="btn btn-danger my-2" style="width: 200px;" value="Agregar"
                                                    id="btnAgregarCategoria" name="btnAgregarCategoria">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <?php PrintScript(); ?>
        </body>
</html>