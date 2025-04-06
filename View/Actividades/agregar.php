<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DireccionesModel.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ActividadesController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/CategoriasModel.php";

    $listaProvincias = ConsultarProvinciasModel(); 
    $listaCantones   = ConsultarCantonesModel(); 
    $listaCategorias = ConsultarCategoriasModel(); 
?>

<!DOCTYPE html>
<html>
    <?php printCSS(); ?>
    <body id="page-top">
        <?php BarraNavegacion(); ?>
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div style="margin-top: 13%;">
                                    <div class="text-center">
                                        <h1 class="h1 text-gray-600 mb-4 mt-0">Crear Actividad</h1>
                                    </div>
                                    <?php
                                        if(isset($_POST["Message"]))
                                        {
                                            echo '<div class="alert alert-warning Mensajes">' . $_POST["Message"] . '</div>';                                   
                                        }
                                    ?>
                                    
                                    <form id="frmActividad" action="" method="POST"> 
                                        <div class="form-group">
                                            <label for="txtNombre">Nombre</label>
                                            <input type="text" class="form-control is-valid" id="txtNombre" name="txtNombre" placeholder="Nombre de la Actividad" required>
                                        </div>
                                         
                                        <div class="form-row my-2">
                                            <div class="form-group col-md-6">
                                                <label for="txtProvincia">Provincia</label>
                                                <select class="form-control" id="txtProvincia" name="txtProvincia" required>
                                                    <option value="">Seleccione...</option>
                                                    <?php
                                                        if($listaProvincias != null)
                                                        {
                                                            while($row = mysqli_fetch_array($listaProvincias))
                                                            {
                                                                echo "<option value='" . $row["id_provincias"] . "'>" 
                                                                     . $row["nombre"] . "</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="txtCanton">Cantón</label>
                                                <select class="form-control" id="txtCanton" name="txtCanton" required>
                                                    <option value="">Seleccione...</option>
                                                    <?php
                                                        if($listaCantones != null)
                                                        {
                                                            while($row = mysqli_fetch_array($listaCantones))
                                                            {
                                                                echo "<option value='" . $row["id_canton"] . "'>" 
                                                                     . $row["nombre"] . "</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="txtDescripcion">Descripcion</label>
                                            <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3"></textarea>
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="txtIncluye">Incluye</label>
                                            <textarea class="form-control" id="txtIncluye" name="txtIncluye" rows="3"></textarea>
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="txtPuntoEncuentro">Punto de Encuentro</label>
                                            <input type="text" class="form-control" id="txtPuntoEncuentro" name="txtPuntoEncuentro">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="txtPrecio">Precio</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₡</span>
                                                </div>
                                                <input type="text" class="form-control is-valid" id="txtPrecio" name="txtPrecio" placeholder="Precio" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" id="btnGuardar" name="btnGuardar" style="display:none;">
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
        <div class="fixed-bottom">
            <div class="container-fluid px-5">
                <div class="progress" style="height: 15px;">
                    <div id="progressBar" class="progress-bar bg-danger" role="progressbar"
                         style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4" style="margin-bottom: 1%;">
                    <a href="../Categorias/listado.php" class="btn btn-secondary">Atras</a>
                    <button type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
        <?php PrintScript(); ?>
        <script>src="../Scripts/formularioActtivadad.js"</script>
    </body>
</html>
