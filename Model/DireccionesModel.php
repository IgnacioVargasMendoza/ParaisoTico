<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

    function ConsultarProvinciasModel()
    {
        try {
            $conn = AbrirBaseDatos(); 

            $sentencia = "CALL SP_ConsultarProvincias();";
            $resultado = $conn->query($sentencia);

            CerrarBaseDatos($conn);
            return $resultado;
        } catch (Exception $error) {
            return null;
        }
    }

    function ConsultarCantonesModel()
    {
        try {
            $conn = AbrirBaseDatos();

            $sentencia = "CALL SP_ConsultarCantones();";
            $resultado = $conn->query($sentencia);

            CerrarBaseDatos($conn);
            return $resultado;
        } catch (Exception $error) {
            return null;
        }
    }
?>
