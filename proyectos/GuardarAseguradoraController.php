<?php
require_once '../config/database.php';
ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $cif = $_POST['cif'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $persona_contacto = $_POST['contacto'] ?? '';

    $db = Database::conectar();
    $stmt = $db->prepare("INSERT INTO aseguradoras (nombre, domicilio, cif, telefono, email, persona_contacto) VALUES (?, ?, ?, ?, ?, ?)");
    $exito = $stmt->execute([$nombre, $domicilio, $cif, $telefono, $email, $persona_contacto]);

    if ($exito) {
        header("Location: ../views/form_aseguradoras.php?creado=1");
        exit;
    } else {
        echo "❌ Error al registrar la aseguradora.";
    }
}
