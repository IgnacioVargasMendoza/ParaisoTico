<?php
// app/controllers/ControllerReservacion.php
require_once 'Model/Reservacion.php';
require_once 'Model/Actividad.php';
require_once 'Model/Oferta.php';

class ControllerReservacion
{
    // VISTAS
    public function index()
    {
        $reservaciones = Reservacion::all();
        include 'View/reservacion/index.php';
    }

    
    public function reservar()
    {
        $actividades = Actividad::all();
        $ofertas = Oferta::all();
        include 'View/reservacion/reservacion.php';
    }

    public function edit($id)
    {
        $reservacion = Reservacion::find($id);
        include 'view/reservaciones/edit.php';
    }

    public function show($id)
    {
        // Verificar autenticación
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?route=login&action=login');
        exit;
    }

    // Obtener la reserva
    $reserva = Reservacion::find($id);
    // return $reserva;    
    
    if (!$reserva) {
        $_SESSION['error'] = "Reserva no encontrada";
        header('Location: index.php?route=reservacion');
        exit;
    }

    // Verificar que la reserva pertenece al usuario
    if ($reserva->id_usuario != $_SESSION['usuario']['id_usuario']) {
        $_SESSION['error'] = "No tienes permiso para ver esta reserva";
        header('Location: index.php?route=reservacion');
        exit;
    }

    // Obtener datos relacionados
    $actividad = Actividad::find($reserva->id_actividad);
    if (!$actividad) {
        $_SESSION['error'] = "Actividad no encontrada";
        header('Location: index.php?route=reservacion');
        exit;
    }

    $oferta = null;
    if (!empty($reserva->id_oferta)) {
        $oferta = Oferta::find($reserva->id_oferta);
    }

    // Obtener datos actualizados del usuario desde la base de datos
    $usuario = Usuario::find($_SESSION['usuario']['id_usuario']);
    if (!$usuario) {
        $_SESSION['error'] = "Usuario no encontrado";
        header('Location: index.php?route=reservacion');
        exit;
    }

    // Incluir la vista correcta (show.php en lugar de index.php)
    include 'View/reservacion/show.php';
    }

    // ACCIONES

    public function store($request)
    {
        try {
        // Validar y formatear las fechas
        $fechaInicio = DateTime::createFromFormat('Y-m-d\TH:i', $request['fecha_reserva']);
        $fechaFin = DateTime::createFromFormat('Y-m-d\TH:i', $request['fecha_actividad']);
        if (!$fechaInicio || !$fechaFin) {
            die("Formato de fecha inválido");
        }

        $reservacion = new Reservacion();
        $reservacion->id_usuario = $request['id_usuario'];
        $reservacion->id_actividad = $request['id_actividad'];
        $reservacion->id_oferta = $request['id_oferta'] ?? null; // Por si es opcional
    
        // Formatear fechas para MySQL (formato Y-m-d H:i:s)
        $reservacion->fecha_reserva = $fechaInicio->format('Y-m-d H:i:s');
        $reservacion->fecha_actividad = $fechaFin->format('Y-m-d H:i:s');
    
        $reservacion->activo = 1; // 1 para "activo" o "pendiente"
        // Calcular el total basado en actividad y oferta
        $actividad = Actividad::find($request['id_actividad']);
        $total = $actividad->precio;

        if (!empty($request['id_oferta'])) {
            $oferta = Oferta::find($request['id_oferta']);
            $total = $total * (1 - ($oferta->descuento / 100));
        }

        $reservacion->total = $total;

        $reservacion->save();
        $_SESSION['success'] = "Reservación creada exitosamente";
        header('Location: index.php?route=reservacion&action=index');
        exit();
        } catch (Exception $e) {
        // Manejo de errores - puedes redirigir a una página de error
        $_SESSION['error'] = $e->getMessage();
        header('Location: index.php?route=reservacion&action=reservar');
        exit();
    }
    }

    public function update($request, $id)
    {
        $reservacion = Reservacion::find($id);
        
        $reservacion->id_usuario = $request['id_usuario'];
        $reservacion->id_canton = $request['id_canton'];
        $reservacion->id_categoria = $request['id_categoria'];
        $reservacion->fecha_inicio = $request['fecha_inicio'];
        $reservacion->fecha_fin = $request['fecha_fin'];
        $reservacion->numero_personas = $request['numero_personas'];
        $reservacion->total = $request['total'];
        $reservacion->estado = $request['estado'];

        $reservacion->update();

        header('Location: index.php?route=reservaciones');
    }

    public function destroy($id)
    {
        $reservacion = Reservacion::find($id);
        $reservacion->delete();

        header('Location: index.php?route=reservaciones');
    }
}