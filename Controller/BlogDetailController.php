<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";


function obtenerBlogPorId(int $id): ?array
{
    $mysqli = AbrirBaseDatos();
    $stmt = $mysqli->prepare("CALL SP_ObtenerBlogPorId(?)");
    if (!$stmt) {
        trigger_error("Prepare falló: " . $mysqli->error, E_USER_ERROR);
    }

    $stmt->bind_param("i", $id);
    if (! $stmt->execute()) {
        trigger_error("Execute falló: " . $stmt->error, E_USER_ERROR);
    }

    $res = $stmt->get_result();
    $blog = $res->fetch_assoc() ?: null;

    $res->free();

    while ($mysqli->more_results() && $mysqli->next_result()) {
        if ($extra = $mysqli->store_result()) {
            $extra->free();
        }
    }
    $stmt->close();
    CerrarBaseDatos($mysqli);

    if ($blog) {
        $blog['imagen_data'] = !empty($blog['imagen'])
            ? "data:image/jpeg;base64," . base64_encode($blog['imagen'])
            : "../Img/default.jpg";
    }
    return $blog;
}

function obtenerGaleriaPorBlog(int $id): array
{
    $mysqli = AbrirBaseDatos();
    $stmt   = $mysqli->prepare("CALL SP_ObtenerGaleriaPorBlog(?)");
    if (!$stmt) {
        trigger_error("Prepare falló: " . $mysqli->error, E_USER_ERROR);
    }
    $stmt->bind_param("i", $id);
    if (! $stmt->execute()) {
        trigger_error("Execute falló: " . $stmt->error, E_USER_ERROR);
    }
    $res       = $stmt->get_result();
    $imagenes  = [];
    while ($row = $res->fetch_assoc()) {
        if (!empty($row['imagen'])) {
            $imagenes[] = "data:image/jpeg;base64," . base64_encode($row['imagen']);
        }
    }
    $res->free();
    while ($mysqli->more_results() && $mysqli->next_result()) {
        if ($extra = $mysqli->store_result()) {
            $extra->free();
        }
    }
    $stmt->close();
    CerrarBaseDatos($mysqli);

    return $imagenes;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "Blog no encontrado."; exit;
}

$blog    = obtenerBlogPorId($id);
if (! $blog) {
    echo "Blog no encontrado."; exit;
}

$galeria = obtenerGaleriaPorBlog($id);
$chunks  = array_chunk($galeria, 3);
?>
