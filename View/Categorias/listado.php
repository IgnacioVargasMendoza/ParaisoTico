<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/CategoriaController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/View/layoutInterno.php";
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
                <h1 class="h1 text-gray-900 mb-4">Elige la categoría de la actividad</h1>
              </div>

              <?php if (isset($_POST["Message"])): ?>
                <div class="alert alert-warning Mensajes">
                  <?= $_POST["Message"] ?>
                </div>
              <?php endif; ?>

              <form id="frmCategoria" action="" method="POST" novalidate>
                <div class="container">
                  <div class="row">
                    <?php
                      $listaCategorias = consultarCategorias(1);
                      if (mysqli_num_rows($listaCategorias) > 0) {
                          while ($cat = mysqli_fetch_array($listaCategorias)) {
                              $id = 'cat' . $cat["id_categorias"];
                              echo "
                              <div class=\"col-md-6 col-sm-12 mb-3\">
                                <input
                                  type=\"radio\"
                                  name=\"opcionesCategoria\"
                                  id=\"$id\"
                                  class=\"btn-check\"
                                  value=\"{$cat['id_categorias']}\"
                                  autocomplete=\"off\"
                                  required
                                >
                                <label
                                  class=\"btn btn-outline-secondary w-100 btn-lg\"
                                  for=\"$id\"
                                >
                                  " . htmlspecialchars($cat["nombre"]) . "
                                </label>
                              </div>";
                          }
                      } else {
                          echo '<div class="col-12"><p class="text-center">No hay categorías disponibles</p></div>';
                      }
                    ?>
                  </div>
                  <div id="errorCategoria" class="text-danger small mt-1" style="display:none;">
                    Por favor selecciona una categoría.
                  </div>
                </div>

                <!-- Modal trigger button -->
                <div class="mb-3">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAgregarCategoria"
                  >
                    <i class="fas fa-plus"></i> Agregar categoría
                  </button>
                </div>

                <div class="fixed-bottom">
                  <div class="container-fluid px-5">
                    <div class="progress" style="height:15px;">
                      <div
                        id="progressBar"
                        class="progress-bar bg-danger"
                        role="progressbar"
                        style="width:50%;"
                        aria-valuenow="50"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-between mt-4 mb-1">
                      <a href="../Login/home.php" class="btn btn-secondary">Atrás</a>
                      <button type="submit" name="btnContinuar" class="btn btn-primary">
                        Continuar
                      </button>
                    </div>
                  </div>
                </div>
              </form>

              <!-- Modal for adding new category -->
              <div
                class="modal fade"
                id="modalAgregarCategoria"
                tabindex="-1"
                aria-labelledby="modalAgregarCategoriaLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalAgregarCategoriaLabel">Agregar Nueva Categoría</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <form action="" method="POST">
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="txtCategoria">Categoría</label>
                          <input
                            type="text"
                            class="form-control"
                            id="txtCategoria"
                            name="txtCategoria"
                            maxlength="50"
                            required
                          >
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="submit"
                          id="btnGuardar"
                          name="btnGuardar"
                          class="btn btn-primary"
                        >
                          Guardar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /Modal -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php PrintScript(); ?>
  <script src="../Scripts/categoria.js"></script>
</body>
</html>
