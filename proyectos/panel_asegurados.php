<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/database.php';
$db = Database::conectar();
$asegurados = $db->query("SELECT * FROM asegurados")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asegurados registrados</title>
  <link rel="stylesheet" href="../public/css/panel_asegurados.css">
</head>
<body>
  <div class="panel-container">
    <h2>Asegurados registrados</h2>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="mensaje-exito"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table class="tabla-asegurados">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Domicilio de reparación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($asegurados as $a): ?>
          <tr>
            <td><?= $a['id'] ?></td>
            <td><?= htmlspecialchars($a['nombre']) ?></td>
            <td><?= htmlspecialchars($a['direccion']) ?></td>
            <td><?= htmlspecialchars($a['telefono']) ?></td>
            <td><?= htmlspecialchars($a['domicilio_reparacion']) ?></td>
            <td>
              <form action="../controllers/EliminarAseguradoController.php" method="GET" onsubmit="return confirm('¿Eliminar este asegurado?');">
                <input type="hidden" name="id" value="<?= $a['id'] ?>">
                <button type="submit" class="btn eliminar">🗑 Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

   <div class="enlaces-acciones">
  <a href="form_asegurado.php" class="link-accion">Registrar nuevo asegurado</a>
  <a href="../index.php" class="link-accion">← Volver al inicio</a>
</div>
</body>
</html>
