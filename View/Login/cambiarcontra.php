<?php
// File: /ParaisoTico/View/Login/recuperar.php

// 1) Arrancamos la sesión para leer mensajes
session_start();

// 2) Incluimos el controlador que procesa btnRecuperarCuenta
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Controller/LoginController.php";

// Vista principal
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/UtilitariosController.php";

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '<link rel="stylesheet" href="../Styles/estilo.css">';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recuperar Contraseña - ParaisoTico</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gradient-primary">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Recuperar Contraseña</h1>
                        </div>

                        <!-- 3) Mostrar mensaje de controlador -->
                        <?php if (!empty($_SESSION["Message"])): ?>
                            <div class="alert alert-warning Mensajes">
                                <?= htmlspecialchars($_SESSION["Message"]) ?>
                            </div>
                            <?php unset($_SESSION["Message"]); ?>
                        <?php endif; ?>

                        <!-- 4) Form action apunta al controlador LoginController -->
                        <form action="/ParaisoTico/Controller/LoginController.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email"
                                       class="form-control"
                                       id="txtCorreo"
                                       name="txtCorreo"
                                       placeholder="Correo electrónico"
                                       required>
                                <label for="txtCorreo">Correo Electrónico</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-info btn-block"
                                        type="submit"
                                        name="btnRecuperarCuenta"
                                        id="btnRecuperarCuenta">
                                    Procesar
                                </button>
                            </div>
                        </form>
                                    
                        <hr>

                        <div class="text-center">
                            <a class="small" href="crearcuenta.php">Crear una Cuenta</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Iniciar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
