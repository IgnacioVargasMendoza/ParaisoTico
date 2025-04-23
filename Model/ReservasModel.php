<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";


function insertarReservaModel(
    int    $id_actividad,
    string $nombre_cliente,
    string $email,
    ?string $telefono,
    string $fecha_reserva,
    int    $num_personas,
    ?string $comentarios,
    string $estado = 'pendiente'
): bool {
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare(
        "CALL SP_InsertarReserva(?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "issssiis",
        $id_actividad,
        $nombre_cliente,
        $email,
        $telefono,
        $fecha_reserva,
        $num_personas,
        $comentarios,
        $estado
    );
    $ok = $stmt->execute();
    $stmt->close();
    CerrarBaseDatos($db);
    return (bool) $ok;
}


function consultarReservasModel(): array {
    $db   = AbrirBaseDatos();
    $stmt = $db->prepare("CALL SP_ConsultarReservas()");
    $stmt->execute();
    $res = $stmt->get_result();
    $reservas = [];
    while ($row = $res->fetch_assoc()) {
        $reservas[] = $row;
    }
    $stmt->close();
    CerrarBaseDatos($db);
    return $reservas;
}
?>