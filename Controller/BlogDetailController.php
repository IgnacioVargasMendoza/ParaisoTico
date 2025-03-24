<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

/**
 * Obtiene los datos del blog según el id.
 *
 * @param int $id El id del blog.
 * @return array|null Devuelve el blog como arreglo asociativo o null si no se encontró.
 */
function obtenerBlogPorId($id) {
    $conexion = AbrirBaseDatos();
    $stmt = $conexion->prepare("SELECT id_blog, titulo, contenido, contacto, actividades, detallado, incluye, imagen FROM Blog WHERE id_blog = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        $blog = null;
    } else {
        $blog = $resultado->fetch_assoc();
        // Si se almacena la imagen en binario, la codificamos para mostrarla en línea
        if (!empty($blog['imagen'])) {
            $blog['imagen_data'] = "data:image/jpeg;base64," . base64_encode($blog['imagen']);
        } else {
            $blog['imagen_data'] = "../Img/default.jpg"; // Ruta por defecto
        }
    }
    $stmt->close();
    CerrarBaseDatos($conexion);
    return $blog;
}

/**
 * Obtiene las imágenes de la galería asociadas a un blog.
 *
 * @param int $id El id del blog.
 * @return array Devuelve un arreglo con los datos de las imágenes.
 */
function obtenerGaleriaPorBlog($id) {
    $conexion = AbrirBaseDatos();
    $stmt = $conexion->prepare("SELECT imagen FROM imagenes_blog WHERE id_blog = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    $imagenes = array();
    while ($row = $resultado->fetch_assoc()) {
        if (!empty($row['imagen'])) {
            $imagenes[] = "data:image/jpeg;base64," . base64_encode($row['imagen']);
        }
    }
    $stmt->close();
    CerrarBaseDatos($conexion);
    return $imagenes;
}

// Obtener el id del blog a mostrar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    echo "Blog no encontrado.";
    exit;
}

$blog = obtenerBlogPorId($id);
if (!$blog) {
    echo "Blog no encontrado.";
    exit;
}

$galeria = obtenerGaleriaPorBlog($id);
// Agrupar las imágenes en grupos de 3 para facilitar su visualización, por ejemplo en un carrusel
$chunks = array_chunk($galeria, 3);
?>