<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/ReservasModel.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_actividad'])) {
    $id_actividad   = (int) ($_POST['id_actividad'] ?? 0);
    $nombre_cliente = trim($_POST['nombre_cliente'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $telefono       = trim($_POST['telefono'] ?? '') ?: null;
    $fecha_reserva  = trim($_POST['fecha_reserva'] ?? '');
    $num_personas   = (int) ($_POST['num_personas'] ?? 0);
    $comentarios    = trim($_POST['comentarios'] ?? '') ?: null;
    $estado         = 'pendiente';


    if ($id_actividad > 0 && $nombre_cliente && $email && $fecha_reserva && $num_personas > 0) {
        $ok = insertarReservaModel(
            $id_actividad,
            $nombre_cliente,
            $email,
            $telefono,
            $fecha_reserva,
            $num_personas,
            $comentarios,
            $estado
        );
    } else {
        $ok = false;
    }


    $params = $ok
        ? '?mensaje=' . urlencode('Reserva creada correctamente')
        : '?error='   . urlencode('Error al crear la reserva');
    header("Location: /ParaisoTico/View/Reservas/listado.php{$params}");
    exit;
}


function listarReservas(): array {
    return consultarReservasModel();
}
