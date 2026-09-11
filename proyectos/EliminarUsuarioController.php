<?php
session_start();
require_once '../config/database.php';

// Validar sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: ../views/login.php');
    exit;
}

$usuarioActual = $_SESSION['usuario'];
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    header('Location: ../views/panel_usuarios.php?error=sin_id');
    exit;
}

$db = Database::conectar();

// Obtener el rol del usuario que se quiere eliminar
$stmt = $db->prepare("SELECT rol FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuarioObjetivo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuarioObjetivo) {
    header('Location: ../views/panel_usuarios.php?error=no_encontrado');
    exit;
}

// ⚠️ Control de permisos
if ($usuarioActual['rol'] === 'tecnico' && $usuarioObjetivo['rol'] === 'admin') {
    header('Location: ../views/panel_usuarios.php?error=sin_permiso');
    exit;
}

// Ejecutar eliminación
try {
    $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ../views/panel_usuarios.php?eliminado=ok');
} catch (PDOException $e) {
    header('Location: ../views/panel_usuarios.php?error=bd');
}
