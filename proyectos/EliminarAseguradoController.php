<?php
session_start();
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = Database::conectar();

    try {
        $stmt = $db->prepare("DELETE FROM asegurados WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $_SESSION['success'] = "✅ Asegurado eliminado correctamente.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Error al eliminar: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "❌ ID no recibido.";
}

header('Location: ../views/panel_asegurados.php');
exit;
