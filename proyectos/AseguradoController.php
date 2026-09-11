<?php
session_start();
require_once '../config/database.php';

$db = Database::conectar();

if (
    isset($_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['domicilio_reparacion']) &&
    !empty(trim($_POST['nombre']))
) {
    $nombre = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $domicilio = trim($_POST['domicilio_reparacion']);

    try {
        $sql = "INSERT INTO asegurados (nombre, direccion, telefono, domicilio_reparacion)
                VALUES (:nombre, :direccion, :telefono, :domicilio)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':domicilio' => $domicilio
        ]);

        $_SESSION['success'] = "✅ Asegurado registrado correctamente.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Error al registrar: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "❌ Todos los campos son obligatorios.";
}

header('Location: ../views/form_asegurado.php');
exit;

