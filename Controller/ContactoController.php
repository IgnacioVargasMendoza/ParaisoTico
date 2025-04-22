<?php
    session_start();
    include_once "../Model/DBConexionModel.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        
        $conn = AbrirBaseDatos();

        $query = "INSERT INTO mensajes (nombre, correo, asunto, mensaje, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $nombre, $correo, $asunto, $mensaje);

        if ($stmt->execute()) {
            $_SESSION['MensajeContacto'] = "¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.";
        } else {
            $_SESSION['MensajeContacto'] = "Hubo un problema al enviar el mensaje. Intenta nuevamente.";
        }

        $conn->close();

        header("Location: ../View/Login/contact.php");
        exit();
    }
?>

