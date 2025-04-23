<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

/**
 * Obtiene los datos de un blog por id usando SP.
 */
function obtenerBlogPorId($id) {
    $conexion = AbrirBaseDatos();
    $stmt = $conexion->prepare("CALL sp_obtenerBlogPorId(?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $blog = $res->fetch_assoc() ?: null;
    if ($blog) {
        $blog['imagen_data'] = !empty($blog['imagen'])
            ? "data:image/jpeg;base64," . base64_encode($blog['imagen'])
            : "../Img/default.jpg";
    }
    $stmt->close();
    CerrarBaseDatos($conexion);
    return $blog;
}

/**
 * Obtiene la galería de un blog usando SP.
 */
function obtenerGaleriaPorBlog($id) {
    $conexion = AbrirBaseDatos();
    $stmt = $conexion->prepare("CALL sp_obtenerGaleriaPorBlog(?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $imagenes = [];
    while ($row = $res->fetch_assoc()) {
        if (!empty($row['imagen'])) {
            $imagenes[] = "data:image/jpeg;base64," . base64_encode($row['imagen']);
        }
    }
    $stmt->close();
    CerrarBaseDatos($conexion);
    return $imagenes;
}

// Obtener id y mostrar blog + galería
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    echo "Blog no encontrado."; exit;
}
$blog = obtenerBlogPorId($id);
if (!$blog) {
    echo "Blog no encontrado."; exit;
}
$galeria = obtenerGaleriaPorBlog($id);
$chunks = array_chunk($galeria, 3);
?>