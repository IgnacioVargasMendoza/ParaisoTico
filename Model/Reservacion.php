<?php
// app/models/Reservacion.php
require_once 'DataBaseSQLSetUp/Database.php';

class Reservacion
{
    private static $conn;

    public $id_reserva;
    public $id_usuario;
    public $id_actividad;
    public $id_oferta;
    public $fecha_reserva;
    public $fecha_actividad;
    public $total;
    public $activo;

    public function __construct()
    {
        self::init();
    }

    public static function init()
    {
        if (self::$conn === null) {
            $database = new Database();
            self::$conn = $database->getConnection();
        }
    }

    public static function all()
    {
        // Verificar autenticación
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?route=login&action=login');
        exit;
    }

    // Obtener reservaciones del usuario actual
    $reservaciones = Reservacion::getByUser($_SESSION['usuario']['id_usuario']);
    return $reservaciones;
    // Cargar vista
    include 'app/Views/reservacion/index.php';
        // self::init();

        // $query = "SELECT * FROM Reservas;";
        // $stmt = self::$conn->prepare($query);
        // $stmt->execute();

        // $data = [];

        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     $item = new self();
        //     $item->id_reservacion = $row['id_reservacion'];
        //     $item->id_usuario = $row['id_usuario'];
        //     $item->id_actividad = $row['id_actividad'];
        //     $item->id_oferta = $row['id_oferta'];
        //     $item->fecha_reserva = $row['fecha_reserva'];
        //     $item->fecha_actividad = $row['fecha_actividad'];
        //     $item->total = $row['total'];
        //     $item->activo = $row['activo'];

        //     $data[] = $item;
        // }

        // return $data;
    }

    public static function find($id)
    {
        self::init();

        $query = "SELECT * FROM Reservas WHERE id_reserva = :id;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $item = new Reservacion();
            $item->id_reserva = $row['id_reserva'];
            $item->id_usuario = $row['id_usuario'];
            $item->id_actividad = $row['id_actividad'];
            $item->id_oferta = $row['id_oferta'];
            $item->fecha_reserva = $row['fecha_reserva'];
            $item->fecha_actividad = $row['fecha_actividad'];
            $item->total = $row['total'];
            $item->activo = $row['activo'];

            return $item;
        }

        return null;
    }

    public function save()
    {
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO Reservas (id_usuario, id_actividad, id_oferta, fecha_reserva, fecha_actividad, total, activo) 
                  VALUES (:id_usuario, :id_actividad, :id_oferta, :fecha_reserva, :fecha_actividad, :total, :activo);";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':id_usuario' => $this->id_usuario,
            ':id_actividad' => $this->id_actividad,
            ':id_oferta' => $this->id_oferta,
            ':fecha_reserva' => $this->fecha_reserva,
            ':fecha_actividad' => $this->fecha_actividad,
            ':total' => $this->total,
            ':activo' => $this->activo,
        ]);
    }

    public function update()
    {
        $query = "UPDATE Reservas SET 
                  id_usuario = :id_usuario,
                  id_actividad = :id_actividad,
                  id_oferta = :id_oferta,
                  fecha_reserva = :fecha_reserva,
                  fecha_actividad = :fecha_actividad,
                  total = :total,
                  activo = :activo
                  WHERE id_reservacion = :id;";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':id_usuario' => $this->id_usuario,
            ':id_actividad' => $this->id_actividad,
            ':id_oferta' => $this->id_oferta,
            ':fecha_reserva' => $this->fecha_reserva,
            ':fecha_actividad' => $this->fecha_actividad,
            ':total' => $this->total,
            ':activo' => $this->activo,
        ]);
    }

    public function delete()
    {
        $query = "DELETE FROM Reservas WHERE id_reservacion = :id;";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([':id' => $this->id_reservacion]);
    }

    public static function makeReservation($data)
    {
        self::init();
        $query = "INSERT INTO Reservas (id_usuario, id_canton, id_categoria, fecha_inicio, fecha_fin, numero_personas, total, estado) 
                  VALUES (:id_usuario, :id_canton, :id_categoria, :fecha_inicio, :fecha_fin, :numero_personas, :total, 'pendiente');";
        $stmt = self::$conn->prepare($query);
        return $stmt->execute([
            ':id_usuario' => $data['id_usuario'],
            ':id_canton' => $data['id_canton'],
            ':id_categoria' => $data['id_categoria'],
            ':fecha_inicio' => $data['fecha_inicio'],
            ':fecha_fin' => $data['fecha_fin'],
            ':numero_personas' => $data['numero_personas'],
            ':total' => $data['total'],
        ]);
    }

    public static function getByUser($userId)
{
    self::init();
    
    $query = "SELECT * FROM Reservas 
              WHERE id_usuario = :user_id 
              ORDER BY fecha_actividad DESC";
    $stmt = self::$conn->prepare($query);
    $stmt->execute([':user_id' => $userId]);
    
    $reservaciones = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $reserva = new Reservacion();
        $reserva->id_reserva = $row['id_reserva'];
        $reserva->id_usuario = $row['id_usuario'];
            $reserva->id_actividad = $row['id_actividad'];
            $reserva->id_oferta = $row['id_oferta'];
            $reserva->fecha_reserva = $row['fecha_reserva'];
            $reserva->fecha_actividad = $row['fecha_actividad'];
            $reserva->total = $row['total'];
            $reserva->activo = $row['activo'];
            
            $reservaciones[] = $reserva;
        }
        
        return $reservaciones;
    }
}