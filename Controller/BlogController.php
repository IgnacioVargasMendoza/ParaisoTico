<?php
// filepath: c:\Users\carlo\OneDrive\Escritorio\Proyecto Maria\ParaisoTico\Controller\BlogController.php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

/**
 * Obtiene todos los blogs de la base de datos.
 *
 * @return array Devuelve un arreglo con los blogs, cada uno en forma de arreglo asociativo.
 */
function obtenerBlogs() {
    $conexion = AbrirBaseDatos();
    $consulta = "SELECT id_blog, titulo, resumen, contenido, contacto, actividades, detallado, incluye, imagen FROM Blog ORDER BY id_blog ASC";
    $resultado = $conexion->query($consulta);
    
    $blogs = array();
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Si se almacena la imagen en binario, la codificamos para mostrarla en línea:
            if (!empty($fila['imagen'])) {
                $fila['imagen_data'] = "data:image/jpeg;base64," . base64_encode($fila['imagen']);
            } else {
                $fila['imagen_data'] = null;
            }
            $blogs[] = $fila;
        }
    }
    CerrarBaseDatos($conexion);
    return $blogs;
}

/**
 * Inserta un nuevo blog y sus imágenes de galería en la base de datos.
 *
 * @param string $titulo         Título del blog.
 * @param string $resumen        Resumen del blog.
 * @param string $contenido      Contenido completo.
 * @param string $contacto       Información de contacto.
 * @param string $actividades    Actividades a realizar.
 * @param string $detallado      Descripción detallada.
 * @param string $incluye        Información de qué incluye.
 * @param string $imagen         Contenido binario de la imagen principal.
 * @param int    $id_usuario     Identificador del usuario.
 * @param array  $galeria        Arreglo de imágenes (contenido binario) para la galería. Puede estar vacío.
 *
 * @return bool                  TRUE si la inserción es exitosa, FALSE en caso de error o falta de datos obligatorios.
 */
function insertarBlogCompleto($titulo, $resumen, $contenido, $contacto, $actividades, $detallado, $incluye, $imagen, $id_usuario, $galeria = array()) {
    // Validar que todos los datos obligatorios estén presentes
    if(empty($titulo) || empty($resumen) || empty($contenido) || empty($contacto) ||
       empty($actividades) || empty($detallado) || empty($incluye) || empty($imagen) || empty($id_usuario)) {
        return false;
    }
    
    $conexion = AbrirBaseDatos();
    
    // Iniciar transacción
    $conexion->autocommit(false);
    
    // Preparar inserción principal en la tabla Blog
    $stmt = $conexion->prepare("INSERT INTO Blog (titulo, resumen, contenido, contacto, actividades, detallado, incluye, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if(!$stmt) {
        CerrarBaseDatos($conexion);
        return false;
    }

    // "ssssssss": 8 strings.
    $stmt->bind_param("ssssssss", $titulo, $resumen, $contenido, $contacto, $actividades, $detallado, $incluye, $imagen);

    if(!$stmt->execute()) {
        $stmt->close();
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    
    // Obtener el id insertado en Blog para vincular la galería
    $id_blog = $conexion->insert_id;
    $stmt->close();
    
    // Insertar imágenes de la galería si existen
    if(!empty($galeria)) {
        $stmtGaleria = $conexion->prepare("INSERT INTO Imagenes_Blog (id_blog, imagen) VALUES (?, ?)");
        if(!$stmtGaleria) {
            $conexion->rollback();
            CerrarBaseDatos($conexion);
            return false;
        }
        foreach($galeria as $imagenGaleria) {
            $stmtGaleria->bind_param("is", $id_blog, $imagenGaleria);
            if(!$stmtGaleria->execute()){
                $stmtGaleria->close();
                $conexion->rollback();
                CerrarBaseDatos($conexion);
                return false;
            }
        }
        $stmtGaleria->close();
    }
    
    // Confirmar la transacción
    if(!$conexion->commit()){
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    
    CerrarBaseDatos($conexion);
    return true;
}

/**
 * Elimina un blog y sus imágenes de galería de la base de datos.
 *
 * @param int $id_blog Identificador del blog.
 * @return bool TRUE si la eliminación fue exitosa, FALSE de lo contrario.
 */
function eliminarBlog($id_blog) {
    $conexion = AbrirBaseDatos();
    $conexion->autocommit(false);
    
    // Eliminar las imágenes de la galería asociadas al blog.
    $stmtGaleria = $conexion->prepare("DELETE FROM Imagenes_Blog WHERE id_blog = ?");
    if(!$stmtGaleria) {
        CerrarBaseDatos($conexion);
        return false;
    }
    $stmtGaleria->bind_param("i", $id_blog);
    if(!$stmtGaleria->execute()){
        $stmtGaleria->close();
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    $stmtGaleria->close();
    
    // Eliminar el blog.
    $stmt = $conexion->prepare("DELETE FROM Blog WHERE id_blog = ?");
    if(!$stmt) {
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    $stmt->bind_param("i", $id_blog);
    if(!$stmt->execute()){
        $stmt->close();
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    $stmt->close();
    
    if(!$conexion->commit()){
        $conexion->rollback();
        CerrarBaseDatos($conexion);
        return false;
    }
    
    CerrarBaseDatos($conexion);
    return true;
}

// Procesamiento de inserción del blog cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"])) {

    // Recoger y sanitizar los datos
    $titulo       = trim($_POST['titulo'] ?? '');
    $resumen      = trim($_POST['resumen'] ?? '');
    $contenido    = trim($_POST['contenido'] ?? '');
    $contacto     = trim($_POST['contacto'] ?? '');
    $actividades  = trim($_POST['actividades'] ?? '');
    $detallado    = trim($_POST['detallado'] ?? '');
    $incluye      = trim($_POST['incluye'] ?? '');
    // Para efectos del ejemplo, asignamos el id_usuario de forma fija.
    $id_usuario   = 1;

    // Validar campos obligatorios
    if (empty($titulo) || empty($resumen) || empty($contenido) || empty($contacto) || 
        empty($actividades) || empty($detallado) || empty($incluye) || !isset($_FILES['imagen'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Todos los campos obligatorios deben completarse."));
        exit;
    }

    // Procesar la imagen principal
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenContenido = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Error al subir la imagen principal."));
        exit;
    }

    // Procesar imágenes de la galería (opcional)
    $galeria = array();
    if (isset($_FILES['imagenes_blog']) && count($_FILES['imagenes_blog']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['imagenes_blog']['name']); $i++) {
            if ($_FILES['imagenes_blog']['error'][$i] === UPLOAD_ERR_OK) {
                $galeria[] = file_get_contents($_FILES['imagenes_blog']['tmp_name'][$i]);
            }
        }
    }
    
    // Insertar el blog usando la función definida
    $resultado = insertarBlogCompleto($titulo, $resumen, $contenido, $contacto, $actividades, $detallado, $incluye, $imagenContenido, $id_usuario, $galeria);

    if($resultado) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?mensaje=" . urlencode("Blog creado exitosamente."));
        exit;
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Error al crear el blog. Por favor, inténtalo de nuevo."));
        exit;
    }
}

// Si se recibe la acción de eliminación vía GET, se procede a eliminar el blog.
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id_blog'])) {
    $id_blog = intval($_GET['id_blog']);
    if(eliminarBlog($id_blog)) {
        header("Location: /ParaisoTico/View/Login/blog.php?mensaje=" . urlencode("Blog eliminado correctamente."));
        exit;
    } else {
        header("Location: /ParaisoTico/View/Login/blog.php?error=" . urlencode("Error al eliminar el blog."));
        exit;
    }
}

?>