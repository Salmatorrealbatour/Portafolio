<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = strtolower(trim($_POST['email']));
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // 🔐 Encriptación segura
    $rol = $_POST['rol'];

    $db = Database::conectar();

    // Verificar si el correo ya existe
    $verificar = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
    $verificar->execute([':email' => $email]);

    if ($verificar->fetchColumn() > 0) {
        $_SESSION['error'] = "❌ El correo ya está registrado.";
        header('Location: ../views/form_usuario.php');
        exit;
    }

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :clave, :rol)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':clave' => $clave,
        ':rol' => $rol
    ]);

    $_SESSION['success'] = "✅ Usuario creado correctamente.";
    header('Location: ../views/panel_usuarios.php');
    exit;
}
