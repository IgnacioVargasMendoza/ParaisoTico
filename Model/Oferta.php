<?php
// app/models/Oferta.php
require_once 'DataBaseSQLSetUp/Database.php';

class Oferta
{
    private static $conn;

    public $id_oferta;
    public $descripcion;
    public $descuento;
    public $fecha_publicacion;
    public $fecha_inicio;
    public $fecha_fin;
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
        self::init();

        $query = "SELECT * FROM Ofertas WHERE activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_oferta = $row['id_oferta'];
            $item->descripcion = $row['descripcion'];
            $item->descuento = $row['descuento'];
            $item->fecha_publicacion = $row['fecha_publicacion'];
            $item->fecha_inicio = $row['fecha_inicio'];
            $item->fecha_fin = $row['fecha_fin'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }

    public static function find($id)
    {
        self::init();

        $query = "SELECT * FROM Ofertas WHERE id_oferta = :id AND activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $item = new self();
            $item->id_oferta = $row['id_oferta'];
            $item->descripcion = $row['descripcion'];
            $item->descuento = $row['descuento'];
            $item->fecha_publicacion = $row['fecha_publicacion'];
            $item->fecha_inicio = $row['fecha_inicio'];
            $item->fecha_fin = $row['fecha_fin'];
            $item->activo = $row['activo'];

            return $item;
        }

        return null;
    }

    public function save()
    {
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO Ofertas (descripcion, descuento, fecha_publicacion, fecha_inicio, fecha_fin, activo) 
                  VALUES (:descripcion, :descuento, :fecha_publicacion, :fecha_inicio, :fecha_fin, :activo);";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':descripcion' => $this->descripcion,
            ':descuento' => $this->descuento,
            ':fecha_publicacion' => $this->fecha_publicacion,
            ':fecha_inicio' => $this->fecha_inicio,
            ':fecha_fin' => $this->fecha_fin,
            ':activo' => $this->activo ?? 1,
        ]);
    }

    public function update()
    {
        $query = "UPDATE Ofertas SET 
                  descripcion = :descripcion,
                  descuento = :descuento,
                  fecha_publicacion = :fecha_publicacion,
                  fecha_inicio = :fecha_inicio,
                  fecha_fin = :fecha_fin,
                  activo = :activo
                  WHERE id_oferta = :id;";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':id' => $this->id_oferta,
            ':descripcion' => $this->descripcion,
            ':descuento' => $this->descuento,
            ':fecha_publicacion' => $this->fecha_publicacion,
            ':fecha_inicio' => $this->fecha_inicio,
            ':fecha_fin' => $this->fecha_fin,
            ':activo' => $this->activo,
        ]);
    }

    public function delete()
    {
        // Soft delete (marcar como inactivo)
        $this->activo = 0;
        return $this->update();
    }

    public static function getActiveOffers()
    {
        self::init();
        $currentDate = date('Y-m-d');

        $query = "SELECT * FROM Ofertas 
                  WHERE activo = 1 
                  AND fecha_inicio <= :currentDate 
                  AND fecha_fin >= :currentDate;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':currentDate' => $currentDate]);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_oferta = $row['id_oferta'];
            $item->descripcion = $row['descripcion'];
            $item->descuento = $row['descuento'];
            $item->fecha_publicacion = $row['fecha_publicacion'];
            $item->fecha_inicio = $row['fecha_inicio'];
            $item->fecha_fin = $row['fecha_fin'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }
}