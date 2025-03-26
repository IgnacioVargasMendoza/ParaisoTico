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
                                                <div class="form-group col-md-4">
                                                    <label for="txtCategoria">Categoria</label>
                                                    <select class="form-control" id="txtCategoria" name="txtCategoria" required>
                                                        <option>Seleccione...</option>
                                                            <?php
                                                                if($listaCategorias != null)
                                                                {
                                                                    while($row = mysqli_fetch_array($listaCategorias))
                                                                    {
                                                                        echo "<option value='" . $row["id_categorias"] . "'>" 
                                                                            . $row["nombre"] . "</option>";
                                                                    }
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row my-2">
                                                <div class="form-group col-md-6">
                                                    <label for="txtProvincia">Provincia</label>
                                                    <select class="form-control" id="txtProvincia" 
                                                            name="txtProvincia" required>
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
                                                    <select class="form-control" id="txtCanton" 
                                                            name="txtCanton" required>
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
                                                <label for="exampleInputPassword1">Punto de Encuentro</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="form-group my-3">
                                                <label for="txtPrecio">Precio</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₡</span>
                                                    </div>
                                                    <input type="text" class="form-control is-valid" id="txtPrecio" name="txtPrecio" placeholder="Precio"  required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-danger my-2" style="width: 200px;" value="Agregar"
                                                    id="btnAgregarActividad" name="btnAgregarActividad">
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