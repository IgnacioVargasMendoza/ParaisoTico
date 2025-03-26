<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
    
    function CrearCategoriaModel($nombre)
    {
        try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_CrearOferta('$nombre')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }        
    }  
    
    function ConsultarCategoriasModel()
    {
        try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ConsultarCategorias()";
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