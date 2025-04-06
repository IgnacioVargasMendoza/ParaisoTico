<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/ActividadesModel.php";

    // Habilito el uso de variables de sesion en este archivo
    // Se utiliza el id_categoria almacenado en la vista de Categorias
    // al realizar el registro de una nueva categoria.
    if(session_status()== PHP_SESSION_NONE){
        session_start();
    }


    if(isset($_POST["btnGuardar"]))
    {
        $nombre              = $_POST["txtNombre"];
        $descripcion         = $_POST["txtDescripcion"];
        $precio              = $_POST["txtPrecio"];
        $punto_encuentro     = $_POST["txtPuntoEncuentro"];
        $descripcion_incluye = $_POST["txtIncluye"];
        $id_categoria       = $_SESSION["idCategoria"]; 
        $id_canton           = $_POST["txtCanton"];
        

        if($resultado == true)
        {
            header('Location: ../../View/Actividades/consultarActividades.php');
        }
        else
        {
            $_POST["Message"] = "La actividad no fue registrada correctamente";
        }
    }

?>
