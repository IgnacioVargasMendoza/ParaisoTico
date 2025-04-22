<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

/**
 * Obtiene todos los blogs llamando al proceso almacenado sp_obtenerBlogs.
 */
function obtenerBlogs() {
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare("CALL sp_obtenerBlogs()");
    $stmt->execute();
    $res  = $stmt->get_result();
    $blogs = [];
    while ($row = $res->fetch_assoc()) {
        $row['imagen_data'] = $row['imagen']
            ? "data:image/jpeg;base64," . base64_encode($row['imagen'])
            : null;
        $blogs[] = $row;
    }
    $stmt->close();
    CerrarBaseDatos($db);
    return $blogs;
}

/**
 * Inserta un blog llamando al proceso almacenado sp_insertarBlog
 * Devuelve el id generado o 0.
 */
function insertarBlog($titulo, $resumen, $contenido, $contacto,
                      $actividades, $detallado, $incluye, $imagen) {
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare("CALL sp_insertarBlog(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "ssssssss",
      $titulo, $resumen, $contenido, $contacto,
      $actividades, $detallado, $incluye, $imagen
    );
    $stmt->execute();
    $stmt->bind_result($id_blog);
    $stmt->fetch();
    $stmt->close();
    CerrarBaseDatos($db);
    return (int) $id_blog;
}

/**
 * Inserta una galería de imágenes llamando al proceso almacenado sp_insertarImagenBlog.
 */
function insertarGaleria($id_blog, array $galeria) {
    if ($id_blog <= 0 || empty($galeria)) {
        return;
    }
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare("CALL sp_insertarImagenBlog(?, ?)");
    foreach ($galeria as $img) {
        $stmt->bind_param("is", $id_blog, $img);
        $stmt->execute();
    }
    $stmt->close();
    CerrarBaseDatos($db);
}

/**
 * Inserta blog + galería y retorna true/false.
 */
function insertarBlogCompleto($titulo, $resumen, $contenido, $contacto,
                              $actividades, $detallado, $incluye,
                              $imagen, $galeria = []) {
    if (!$titulo || !$resumen || !$contenido || !$contacto ||
        !$actividades || !$detallado || !$incluye || !$imagen) {
        return false;
    }
    $id = insertarBlog(
        $titulo, $resumen, $contenido, $contacto,
        $actividades, $detallado, $incluye, $imagen
    );
    if ($id <= 0) {
        return false;
    }
    insertarGaleria($id, $galeria);
    return true;
}

/**
 * Elimina un blog y su galería llamando al proceso almacenado sp_eliminarBlogCompleto.
 */
function eliminarBlog($id_blog) {
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare("CALL sp_eliminarBlogCompleto(?)");
    $stmt->bind_param("i", $id_blog);
    $ok   = $stmt->execute();
    $stmt->close();
    CerrarBaseDatos($db);
    return (bool) $ok;
}


// ——— Handlers de formulario ———

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['titulo'])) {
    $titulo      = trim($_POST['titulo']);
    $resumen     = trim($_POST['resumen']);
    $contenido   = trim($_POST['contenido']);
    $contacto    = trim($_POST['contacto']);
    $actividades = trim($_POST['actividades']);
    $detallado   = trim($_POST['detallado']);
    $incluye     = trim($_POST['incluye']);

    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=Imagen principal requerida");
        exit;
    }

    $galeria = [];
    if (!empty($_FILES['imagenes_blog']['name'][0])) {
        foreach ($_FILES['imagenes_blog']['tmp_name'] as $tmp) {
            $galeria[] = file_get_contents($tmp);
        }
    }

    $ok  = insertarBlogCompleto(
        $titulo, $resumen, $contenido, $contacto,
        $actividades, $detallado, $incluye,
        $imagen, $galeria
    );
    $tipo = $ok ? 'mensaje' : 'error';
    $msg  = $ok ? 'Blog creado' : 'Error al crear blog';
    header("Location: {$_SERVER['HTTP_REFERER']}?{$tipo}=" . urlencode($msg));
    exit;
}

if (!empty($_GET['accion']) && $_GET['accion'] === 'eliminar'
    && !empty($_GET['id_blog'])) {
    $id  = (int) $_GET['id_blog'];
    $ok  = eliminarBlog($id);
    $tipo = $ok ? 'mensaje' : 'error';
    $msg  = $ok ? 'Blog eliminado' : 'Error al eliminar blog';
    header("Location: /ParaisoTico/View/Login/blog.php?{$tipo}=" . urlencode($msg));
    exit;
}
?>