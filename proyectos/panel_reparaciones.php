<?php
require_once '../config/database.php';

try {
    $db = Database::conectar();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query("
        SELECT r.id, r.descripcion, r.fecha, r.tecnico, r.costo, r.averia_id, a.descripcion AS averia_descripcion
        FROM reparaciones r
        LEFT JOIN averias a ON r.averia_id = a.id
        ORDER BY r.fecha DESC
    ");

    $reparaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='error'>Error al cargar reparaciones: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Reparaciones</title>
  <link rel="stylesheet" href="../public/css/panel_reparaciones.css">
</head>
<body>
  <div class="panel-container">
    <h2>Listado de Reparaciones</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'eliminado'): ?>
      <div class="mensaje-guardado success">✅ Reparación eliminada correctamente.</div>
    <?php elseif (isset($_GET['success']) && $_GET['success'] === 'editado'): ?>
      <div class="mensaje-guardado success">✅ Reparación actualizada correctamente.</div>
    <?php endif; ?>

    <?php if (empty($reparaciones)): ?>
      <p>No hay reparaciones registradas.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Técnico</th>
            <th>Costo (€)</th>
            <th>Avería</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reparaciones as $rep): ?>
            <tr>
              <td><?= htmlspecialchars($rep['id']) ?></td>
              <td><?= htmlspecialchars($rep['descripcion']) ?></td>
              <td><?= htmlspecialchars($rep['fecha']) ?></td>
              <td><?= htmlspecialchars($rep['tecnico']) ?></td>
              <td><?= htmlspecialchars($rep['costo']) ?></td>
              <td><?= htmlspecialchars($rep['averia_descripcion'] ?? 'Sin descripción') ?></td>
              <td>
                <a href="editar_reparacion.php?id=<?= $rep['id'] ?>" class="btn-editar">✏️ Editar</a>
                <a href="../controllers/EliminarReparacionController.php?id=<?= $rep['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Estás segura de que quieres eliminar esta reparación?')">🗑️ Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <div class="volver-container">
      <a href="../index.php" class="btn-volver">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
