<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/ActividadesModel.php";


    /* function ConsultarActividades()
    {
        return ConsultarActividadesModel();
    }*/

   
    /*function ConsultarActividad($id)
    {
        // Asume que en tu modelo existe ConsultarActividadModel($id)
        $resultado = ConsultarActividadModel($id);
        return mysqli_fetch_array($resultado);
    }*/

    if(isset($_POST["btnCrearActividad"]))
    {
        $nombre              = $_POST["txtNombre"];
        $descripcion         = $_POST["txtDescripcion"];
        $precio              = $_POST["txtPrecio"];
        $punto_encuentro     = $_POST["txtPuntoEncuentro"];
        $descripcion_incluye = $_POST["txtIncluye"];
        $id_categorias       = $_POST["txtCategoria"]; 
        $id_canton           = $_POST["txtCanton"];
        

        $resultado = CrearActividadModel($nombre, $descripcion, $precio, $punto_encuentro, $descripcion_incluye, 
            $id_categorias,
            $id_canton,
        );

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