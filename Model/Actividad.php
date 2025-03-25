<?php
// app/models/Actividad.php
require_once 'DataBaseSQLSetUp/Database.php';

class Actividad
{
    private static $conn;

    public $id_actividad;
    public $nombre;
    public $descripcion;
    public $precio;
    public $punto_encuentro;
    public $descripcion_incluye;
    public $id_categorias;
    public $id_canton;
    public $foto;
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

        $query = "SELECT * FROM Actividades WHERE activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_actividad = $row['id_actividad'];
            $item->nombre = $row['nombre'];
            $item->descripcion = $row['descripcion'];
            $item->precio = $row['precio'];
            $item->punto_encuentro = $row['punto_encuentro'];
            $item->descripcion_incluye = $row['descripcion_incluye'];
            $item->id_categorias = $row['id_categorias'];
            $item->id_canton = $row['id_canton'];
            $item->foto = $row['foto'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }

    public static function find($id)
    {
        self::init();

        $query = "SELECT * FROM Actividades WHERE id_actividad = :id AND activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $item = new self();
            $item->id_actividad = $row['id_actividad'];
            $item->nombre = $row['nombre'];
            $item->descripcion = $row['descripcion'];
            $item->precio = $row['precio'];
            $item->punto_encuentro = $row['punto_encuentro'];
            $item->descripcion_incluye = $row['descripcion_incluye'];
            $item->id_categorias = $row['id_categorias'];
            $item->id_canton = $row['id_canton'];
            $item->foto = $row['foto'];
            $item->activo = $row['activo'];

            return $item;
        }

        return null;
    }

    public function save()
    {
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO Actividades (nombre, descripcion, precio, punto_encuentro, descripcion_incluye, id_categorias, id_canton, foto, activo) 
                  VALUES (:nombre, :descripcion, :precio, :punto_encuentro, :descripcion_incluye, :id_categorias, :id_canton, :foto, :activo);";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':punto_encuentro' => $this->punto_encuentro,
            ':descripcion_incluye' => $this->descripcion_incluye,
            ':id_categorias' => $this->id_categorias,
            ':id_canton' => $this->id_canton,
            ':foto' => $this->foto,
            ':activo' => $this->activo ?? 1,
        ]);
    }

    public function update()
    {
        $query = "UPDATE Actividades SET 
                  nombre = :nombre,
                  descripcion = :descripcion,
                  precio = :precio,
                  punto_encuentro = :punto_encuentro,
                  descripcion_incluye = :descripcion_incluye,
                  id_categorias = :id_categorias,
                  id_canton = :id_canton,
                  foto = :foto,
                  activo = :activo
                  WHERE id_actividad = :id;";
        $stmt = self::$conn->prepare($query);

        return $stmt->execute([
            ':id' => $this->id_actividad,
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':punto_encuentro' => $this->punto_encuentro,
            ':descripcion_incluye' => $this->descripcion_incluye,
            ':id_categorias' => $this->id_categorias,
            ':id_canton' => $this->id_canton,
            ':foto' => $this->foto,
            ':activo' => $this->activo,
        ]);
    }

    public function delete()
    {
        // Soft delete (marcar como inactivo)
        $this->activo = 0;
        return $this->update();
    }

    public static function getByCanton($id_canton)
    {
        self::init();

        $query = "SELECT * FROM Actividades WHERE id_canton = :id_canton AND activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id_canton' => $id_canton]);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_actividad = $row['id_actividad'];
            $item->nombre = $row['nombre'];
            $item->descripcion = $row['descripcion'];
            $item->precio = $row['precio'];
            $item->punto_encuentro = $row['punto_encuentro'];
            $item->descripcion_incluye = $row['descripcion_incluye'];
            $item->id_categorias = $row['id_categorias'];
            $item->id_canton = $row['id_canton'];
            $item->foto = $row['foto'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }

    public static function getByCategoria($id_categoria)
    {
        self::init();

        $query = "SELECT * FROM Actividades WHERE id_categorias = :id_categoria AND activo = 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id_categoria' => $id_categoria]);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_actividad = $row['id_actividad'];
            $item->nombre = $row['nombre'];
            $item->descripcion = $row['descripcion'];
            $item->precio = $row['precio'];
            $item->punto_encuentro = $row['punto_encuentro'];
            $item->descripcion_incluye = $row['descripcion_incluye'];
            $item->id_categorias = $row['id_categorias'];
            $item->id_canton = $row['id_canton'];
            $item->foto = $row['foto'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }
}