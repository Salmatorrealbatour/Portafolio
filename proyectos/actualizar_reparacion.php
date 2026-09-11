<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';

try {
  $db = Database::conectar();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id = $_POST['id'] ?? null;
  $descripcion = $_POST['descripcion'] ?? '';
  $fecha = $_POST['fecha'] ?? '';
  $tecnico = $_POST['tecnico'] ?? '';
  $costo = $_POST['costo'] ?? '';
  $averia_id = $_POST['averia_id'] ?? '';

  if ($id && $descripcion && $fecha && $tecnico && $costo && $averia_id) {
    $stmt = $db->prepare("UPDATE reparaciones SET descripcion = ?, fecha = ?, tecnico = ?, costo = ?, averia_id = ? WHERE id = ?");
    $stmt->execute([$descripcion, $fecha, $tecnico, $costo, $averia_id, $id]);

    header('Location: panel_reparaciones.php?success=editado');
    exit;
  } else {
    echo "<p style='color:red;'>Faltan datos obligatorios.</p>";
  }
} catch (PDOException $e) {
  echo "<p style='color:red;'>Error en la base de datos: " . htmlspecialchars($e->getMessage()) . "</p>";
}
