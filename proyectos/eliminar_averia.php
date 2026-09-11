<?php
session_start();
require_once '../config/database.php';

$db = Database::conectar();
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $db->prepare("DELETE FROM averias WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $_SESSION['success'] = "Avería eliminada correctamente.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Error al eliminar: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "ID de avería no proporcionado.";
}

header("Location: /soluciones_integrales/public/panel_averias.php");
exit;

