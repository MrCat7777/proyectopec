<?php
class Pronostico {
    private $conexion;

    public function __construct() {
        $host = 'localhost';
        $db = 'mundial_db';
        $user = 'root';
        $pass = '';

        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function guardar($datos) {
        $sql = "INSERT INTO pronosticos (nombre, correo, local, visitante, goles_local, goles_visitante, jugador, comentario, analisis, fecha) 
                VALUES (:nombre, :correo, :local, :visitante, :goles_local, :goles_visitante, :jugador, :comentario, :analisis, :fecha)";
        
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':correo', $datos['correo']);
        $stmt->bindParam(':local', $datos['local']);
        $stmt->bindParam(':visitante', $datos['visitante']);
        $stmt->bindParam(':goles_local', $datos['goles_local']);
        $stmt->bindParam(':goles_visitante', $datos['goles_visitante']);
        $stmt->bindParam(':jugador', $datos['jugador']);
        $stmt->bindParam(':comentario', $datos['comentario']);
        $stmt->bindParam(':analisis', $datos['analisis']);
        $stmt->bindParam(':fecha', $datos['fecha']);
        
        $stmt->execute();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM pronosticos ORDER BY id DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>