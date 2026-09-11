<?php
class Database {
    public static function conectar() {
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=soluciones_integrales", "root", "");

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}