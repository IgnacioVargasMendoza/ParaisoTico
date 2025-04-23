<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/CategoriasModel.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if (isset($_POST['btnContinuar'])) {
    
    $_SESSION['idCategoria'] = $_POST['opcionesCategoria'];
    header('Location: ../../View/Actividades/agregar.php');
    exit;
}


if(isset($_POST["btnGuardar"])){

    $nombre = $_POST["txtCategoria"];
    $resultado = CrearCategoriaModel($nombre);

    if($resultado == true){
        header('location: ../../View/Categorias/listado.php');
    }
    else{
        $_POST["Message"] = "Error al Ingresar la Categoria, intente nuevamente!";
    }

}

function consultarCategorias($activo){
    return ConsultarCategoriasModel($activo);
}

?>