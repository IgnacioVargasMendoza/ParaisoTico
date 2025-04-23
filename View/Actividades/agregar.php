<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DireccionesModel.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/ActividadesController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/CategoriasModel.php";

$listaProvincias = ConsultarProvinciasModel();
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
            <div class="col-lg-6" style="margin-top:8%;">
              
              <div class="text-center mb-4">
                <h1 class="h1 text-gray-600">Crear Actividad</h1>
              </div>

              <?php if (isset($_POST["Message"])): ?>
                <div class="alert alert-warning Mensajes">
                  <?= $_POST["Message"] ?>
                </div>
              <?php endif; ?>

              <form id="frmActividad" action="" method="POST" novalidate>
                
                <input type="hidden" name="btnGuardar" value="1">

                <div class="form-group">
                  <label for="txtNombre">Nombre <span class="text-danger">*</span></label>
                  <input
                    type="text"
                    class="form-control"
                    id="txtNombre"
                    name="txtNombre"
                    placeholder="Nombre de la Actividad"
                    required
                  >
                  <div class="invalid-feedback">
                    Por favor ingresa el nombre de la actividad.
                  </div>
                </div>

                <div class="form-group my-3">
                  <label for="txtProvincia">Provincia <span class="text-danger">*</span></label>
                  <select
                    class="form-control"
                    id="txtProvincia"
                    name="txtProvincia"
                    required
                  >
                    <option value="">Seleccione...</option>
                    <?php while ($row = mysqli_fetch_array($listaProvincias)): ?>
                      <option value="<?= $row["id_provincias"] ?>">
                        <?= htmlspecialchars($row["nombre"]) ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una provincia.
                  </div>
                </div>

                <div class="form-group my-3">
                  <label for="txtDescripcion">Descripción</label>
                  <textarea
                    class="form-control"
                    id="txtDescripcion"
                    name="txtDescripcion"
                    rows="3"
                  ></textarea>
                </div>

                <div class="form-group my-3">
                  <label for="txtIncluye">Incluye</label>
                  <textarea
                    class="form-control"
                    id="txtIncluye"
                    name="txtIncluye"
                    rows="3"
                  ></textarea>
                </div>

                <div class="form-group my-3">
                  <label for="txtPuntoEncuentro">Punto de Encuentro</label>
                  <input
                    type="text"
                    class="form-control"
                    id="txtPuntoEncuentro"
                    name="txtPuntoEncuentro"
                  >
                </div>

                <div class="form-group my-3">
                  <label for="txtPrecio">Precio <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">₡</span>
                    </div>
                    <input
                      type="number"
                      class="form-control"
                      id="txtPrecio"
                      name="txtPrecio"
                      placeholder="Precio"
                      required
                    >
                    <div class="invalid-feedback">
                      Ingresa el precio de la actividad.
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Botones fijos abajo (fuera del form) -->
  <div class="fixed-bottom">
    <div class="container-fluid px-5">
      <div class="progress" style="height:15px;">
        <div
          id="progressBar"
          class="progress-bar bg-danger"
          role="progressbar"
          style="width:100%;"
          aria-valuenow="100"
          aria-valuemin="0"
          aria-valuemax="100"
        ></div>
      </div>
      <div class="d-flex justify-content-between mt-4 mb-1">
        <a href="../Categorias/listado.php" class="btn btn-secondary">Atrás</a>
        <button type="button" id="btnGuardar" class="btn btn-primary">
          Guardar
        </button>
      </div>
    </div>
  </div>

  <?php PrintScript(); ?>
  <script src="../Scripts/formularioActividad.js"></script>

</body>
</html>
