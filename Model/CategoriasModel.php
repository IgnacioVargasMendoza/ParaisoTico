<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
    
    function CrearCategoriaModel($nombre)
    {
        try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_InsertarCategoria('$nombre')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }        
    }  
    
    function consultarCategoriasModel($activo)
    {
        try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ConsultarCategorias('$activo')";
            $resultado = $context->query($sentencia);

            CerrarBaseDatos($context);
            return $resultado; 
        } 
        catch (Exception $error) 
        {
            return null;
        }
    }
    
?>