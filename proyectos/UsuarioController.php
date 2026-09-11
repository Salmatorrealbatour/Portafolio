<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['correo'];
    $clave = $_POST['contraseña'];
    $contraseña = hash('sha256', $clave); // Encriptamos la contraseña

    $db = Database::conectar();
  $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :clave";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':clave' => $contraseña
    ]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['usuario'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];
header('Location: ../index.php');

        exit;
    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
     header('Location: ../views/login.php');


        exit;
    }
}

