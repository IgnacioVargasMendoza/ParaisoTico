<?php
    include_once $_SERVER["DOCUMENT_ROOT"] ."/ParaisoTico/Controller/LoginController.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <title>ParaisoTico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/estilo.css">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-5">

          <div class="card">

            <div class="card-body">

              <h5 class="card-title"> Iniciar sesión </h5>

              <form action="" method="POST">

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" name="email" 
                    placeholder="name@example.com" required>
                  <label for="floatingInput">Correo electrónico</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" name="password" 
                    placeholder="Password" required>
                  <label for="floatingPassword">Contraseña</label>
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="rememberPasswordCheck" name="remember">
                  <label class="form-check-label" for="rememberPasswordCheck">
                    Recordar contraseña
                  </label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-login" type="submit" name="btnIniciarSesion">Iniciar sesión</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
