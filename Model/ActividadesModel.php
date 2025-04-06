<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

    function CrearActividadModel($nombre,$descripcion,$precio,$punto_encuentro,$descripcion_incluye,$id_categorias, $rutaImagen, $id_canton)
    {
        try 
        {
            $context = AbrirBaseDatos();
            $sentencia = "CALL SP_InsertarActividad('$nombre','$descripcion','$precio','$punto_encuentro','$descripcion_incluye','$id_categorias', '$rutaImagen', '$id_canton')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }        
    }   
?>