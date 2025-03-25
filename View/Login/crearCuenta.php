<!doctype html>
<html lang="es">
  <head>
    <title>Crear cuenta - ParaisoTico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="View/Styles/estilo.css">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Crear cuenta</h5>
              <form action="index.php?route=login&action=register_action" method="POST" enctype="multipart/form-data">
                <!-- Campo de correo -->
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                  <label for="floatingInput">Correo electrónico</label>
                </div>
                <!-- Campo de username -->
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com" required>
                  <label for="floatingInput">Nombre de Usuario</label>
                </div>
                <!-- Campo de nombre -->
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingNombre" name="nombre" placeholder="Nombre" required>
                  <label for="floatingNombre">Nombre</label>
                </div>
                <!-- Campo de primer apellido -->
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingApellido" name="apellido" placeholder="Apellido" required>
                  <label for="floatingApellido">Primer Apellido</label>
                </div>
                <!-- Campo de contraseña -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                  <label for="floatingPassword">Contraseña</label>
                </div>
                <!-- Confirmar contraseña -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingConfirmPassword" name="confirm_password" placeholder="Confirmar Contraseña" required>
                  <label for="floatingConfirmPassword">Confirmar Contraseña</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="floatingImagen" name="imagen" accept="image/*" required>
                    <label for="floatingImagen">Imagen de perfil</label>
                </div>

                <!-- Mostrar mensaje de error si existe -->
                <?php
                  if (isset($_SESSION["Message"])) {
                      echo "<div class='alert alert-danger mt-3'>" . $_SESSION["Message"] . "</div>";
                      unset($_SESSION["Message"]); // Limpiar el mensaje después de mostrarlo
                  }
                ?>

                <!-- Botón para crear cuenta -->
                <div class="d-grid">
                  <button class="btn btn-login" type="submit">Crear cuenta</button>
                </div>

                <!-- Enlace para iniciar sesión -->
                <div class="text-center">
                  <div class="form-check mb-2">
                    <label class="form-check-label">
                      <a href="index.php?route=login&action=login" class="text-decoration-none">Ya tengo cuenta, iniciar sesión</a>
                    </label>
                  </div>
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