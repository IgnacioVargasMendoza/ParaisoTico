<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['id_usuario'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $idUsuario = $_POST['id_usuario'];

    $conexion = AbrirBaseDatos();

    $consulta = "UPDATE usuario SET nombre = ?, correo = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssi", $nombre, $correo, $idUsuario);

    if ($stmt->execute()) {
        $_SESSION["Message"] = "Perfil actualizado correctamente.";
    } else {
        $_SESSION["Message"] = "Hubo un error al actualizar el perfil.";
    }

    CerrarBaseDatos($conexion);
    header("Location: /ParaisoTico/View/Login/perfil.php");
    exit();
} else {
    $_SESSION["Message"] = "No se enviaron los datos correctamente.";
    header("Location: /ParaisoTico/View/Login/perfil.php");
    exit();
}
