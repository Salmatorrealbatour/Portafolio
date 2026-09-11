<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
  try {
    $db = Database::conectar();
    $stmt = $db->prepare("DELETE FROM reparaciones WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ../views/panel_reparaciones.php?success=eliminado');
    exit;
  } catch (PDOException $e) {
    echo "<p style='color:red;'>Error al eliminar: " . htmlspecialchars($e->getMessage()) . "</p>";
  }
} else {
  echo "<p style='color:red;'>ID no válido para eliminar.</p>";
}
