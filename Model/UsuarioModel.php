<?php
function ValidarUsuarioCorreoModel($correo)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ValidarUsuarioCorreo('$correo')";
            $resultado = $context -> query($sentencia);
    
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }   

    function RecuperarContrasennaModel($id, $codigo)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_RecuperarContrasenna('$id', '$codigo')";
            $resultado = $context -> query($sentencia);
    
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return false;
        }        
    }
    
    ?>