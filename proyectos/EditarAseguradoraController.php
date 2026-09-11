<?php
session_start();
require_once '../config/database.php';

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = 'No autenticado.';
    header('Location: ../views/panel_aseguradoras.php');
    exit;
}

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $nombre = trim($_POST['nombre'] ?? '');
    $domicilio = trim($_POST['domicilio'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    // Guardar datos en sesión para mantenerlos si hay error
    $_SESSION['form_nombre'] = $nombre;
    $_SESSION['form_domicilio'] = $domicilio;
    $_SESSION['form_telefono'] = $telefono;

    // Validación
    if (!$id || !$nombre || !$domicilio || !$telefono) {
        $_SESSION['error'] = 'Todos los campos son obligatorios.';
        header("Location: ../views/editar_aseguradora.php?id=$id");
        exit;
    }

    try {
        $db = Database::conectar();

        // Verificar que la aseguradora existe
        $stmt = $db->prepare("SELECT * FROM aseguradoras WHERE id = ?");
        $stmt->execute([$id]);
        $aseguradora = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$aseguradora) {
            $_SESSION['error'] = 'Aseguradora no encontrada.';
            header('Location: ../views/panel_aseguradoras.php');
            exit;
        }

        // Actualizar datos
        $stmt = $db->prepare("UPDATE aseguradoras SET nombre = ?, domicilio = ?, telefono = ? WHERE id = ?");
        $stmt->execute([$nombre, $domicilio, $telefono, $id]);

        // Limpiar datos temporales
        unset($_SESSION['form_nombre'], $_SESSION['form_domicilio'], $_SESSION['form_telefono']);

        $_SESSION['success'] = 'Aseguradora actualizada correctamente.';
        header('Location: ../views/panel_aseguradoras.php');
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al actualizar: ' . $e->getMessage();
        header("Location: ../views/editar_aseguradora.php?id=$id");
    }
} else {
    $_SESSION['error'] = 'Acceso inválido.';
    header('Location: ../views/panel_aseguradoras.php');
}
