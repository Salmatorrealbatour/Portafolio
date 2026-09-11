<?php
class Usuario {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

 public function autenticar($email, $password) {
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND password = :password");
    $stmt->execute([':email' => $email, ':password' => $password]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    }

