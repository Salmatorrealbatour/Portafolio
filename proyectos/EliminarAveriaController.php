<?php
session_start();
require_once '../config/database.php';

// Validar sesión
if (!isset($_SESSION['usuario'])) {
  $_SESSION['error'] = 'No autenticado.';
  header('Location: ../views/panel_averias.php');
  exit;
}

// Validar ID recibido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  $_SESSION['error'] = 'ID inválido.';
  header('Location: ../views/panel_averias.php');
  exit;
}

$id = intval($_GET['id']);

try {
  $db = Database::conectar();

  // Obtener nombre de imagen antes de eliminar
  $stmt = $db->prepare("SELECT imagen FROM averias WHERE id = ?");
  $stmt->execute([$id]);
  $averia = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$averia) {
    $_SESSION['error'] = 'Avería no encontrada.';
    header('Location: ../views/panel_averias.php');
    exit;
  }

  // Eliminar imagen del servidor si existe
  if (!empty($averia['imagen'])) {
    $rutaImagen = __DIR__ . '/../public/img/averias/' . $averia['imagen'];
    if (file_exists($rutaImagen)) {
      unlink($rutaImagen);
    }
  }

  // Eliminar registro de la base de datos
  $stmt = $db->prepare("DELETE FROM averias WHERE id = ?");
  $stmt->execute([$id]);

  $_SESSION['success'] = 'Avería eliminada correctamente.';
  header('Location: ../views/panel_averias.php');
  exit;

} catch (PDOException $e) {
  $_SESSION['error'] = 'Error al eliminar avería: ' . $e->getMessage();
  header('Location: ../views/panel_averias.php');
  exit;
}
