<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/ActividadesModel.php";
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST["btnGuardar"])) {
    $nombre              = $_POST["txtNombre"];
    $descripcion         = $_POST["txtDescripcion"];
    $precio              = $_POST["txtPrecio"];
    $punto_encuentro     = $_POST["txtPuntoEncuentro"];
    $descripcion_incluye = $_POST["txtIncluye"];
    $id_categoria        = $_SESSION["idCategoria"] ?? null;
    $id_provincia        = $_POST["txtProvincia"] ?? null;

    $resultado = CrearActividadModel(
        $nombre,
        $descripcion,
        $precio,
        $punto_encuentro,
        $descripcion_incluye,
        $id_categoria,
        $id_provincia
    );

    if ($resultado) {
        header('Location: ../../View/Actividades/listado.php');
        exit;
    } else {
        $_POST["Message"] = "La actividad no fue registrada correctamente";
    }
}

function consultarActividadesActivas()
{
    return ConsultarActividadesActivasModel();
}

function consultarActividadPorId($id)
{
    $resultado = ConsultarActividadPorIdModel(intval($id));
    return $resultado ? mysqli_fetch_assoc($resultado) : null;
}

?>