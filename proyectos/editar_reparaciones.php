<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  echo "<p class='error'>ID inválido.</p>";
  exit;
}

$db = Database::conectar();
$stmt = $db->prepare("SELECT * FROM reparaciones WHERE id = ?");
$stmt->execute([$id]);
$reparacion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reparacion) {
  echo "<p class='error'>Reparación no encontrada.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Reparación</title>
  <link rel="stylesheet" href="../public/css/editar_reparaciones.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="form-container">
    <h2>Editar Reparación</h2>
    <form action="actualizar_reparacion.php" method="POST">
      <input type="hidden" name="id" value="<?= $reparacion['id'] ?>">

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($reparacion['descripcion']) ?></textarea>

      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="fecha" value="<?= $reparacion['fecha'] ?>">

      <label for="tecnico">Técnico:</label>
      <input type="text" id="tecnico" name="tecnico" value="<?= htmlspecialchars($reparacion['tecnico']) ?>">

      <label for="costo">Costo (€):</label>
      <input type="number" id="costo" name="costo" value="<?= $reparacion['costo'] ?>" step="0.01">

      <label for="averia_id">ID de Avería:</label>
      <input type="number" id="averia_id" name="averia_id" value="<?= $reparacion['averia_id'] ?>">

      <button type="submit">Actualizar</button>
    </form>

    <div class="volver-container">
      <a href="panel_reparaciones.php" class="btn-volver">← Volver al panel</a>
    </div>
  </div>
</body>
</html>
