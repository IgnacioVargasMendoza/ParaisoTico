<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";

function CrearActividadModel(
    $nombre,
    $descripcion,
    $precio,
    $punto_encuentro,
    $descripcion_incluye,
    $id_categorias,
    $id_provincia
) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = "
            CALL SP_InsertarActividad(
                '$nombre',
                '$descripcion',
                $precio,
                '$punto_encuentro',
                '$descripcion_incluye',
                $id_categorias,
                $id_provincia
            )
        ";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return false;
    }
}

function ConsultarActividadesActivasModel()
{
    try {
        $context = AbrirBaseDatos();
        $resultado = null;

        if ($context->multi_query("CALL SP_ConsultarActividadesActivas()")) {
            $resultado = $context->store_result();
            while ($context->more_results() && $context->next_result()) {
                $extra = $context->store_result();
                if ($extra) {
                    $extra->free();
                }
            }
        }

        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ConsultarActividadPorIdModel($id)
{
    try {
        $context = AbrirBaseDatos();
        $sql = "CALL SP_ConsultarActividadPorId($id)";
        $resultado = $context->query($sql);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

?>
