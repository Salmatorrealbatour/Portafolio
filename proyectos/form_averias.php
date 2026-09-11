<?php
session_start();
require_once '../config/database.php';

$db = Database::conectar();
$asegurados = $db->query("SELECT id, nombre FROM asegurados")->fetchAll(PDO::FETCH_ASSOC);
$aseguradoras = $db->query("SELECT id, nombre FROM aseguradoras")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Avería</title>
  <link rel="stylesheet" href="../public/css/form_averia.css">
</head>
<body>
  <div class="form-wrapper">
    <h2>🔧 Registrar avería</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="mensaje-exito"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="../controllers/AveriaController.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" required>
      </div>

      <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" required>
      </div>

      <div class="form-group">
        <label for="asegurado">Asegurado</label>
        <select name="asegurado" id="asegurado" required>
          <option value="">-- Selecciona --</option>
          <?php foreach ($asegurados as $a): ?>
            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="aseguradora">Aseguradora</label>
        <select name="aseguradora" id="aseguradora" required>
          <option value="">-- Selecciona --</option>
          <?php foreach ($aseguradoras as $as): ?>
            <option value="<?= $as['id'] ?>"><?= htmlspecialchars($as['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="imagen">Imagen de la avería</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" required>
      </div>

      <button type="submit" class="btn">Registrar avería</button>
    </form>

    <a href="/soluciones_integrales/index.php" class="volver">← Volver al menú</a>
  </div>
</body>
</html>
