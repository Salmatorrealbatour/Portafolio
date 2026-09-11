<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Aseguradoras</title>
  <link rel="stylesheet" href="../public/css/panel_aseguradoras.css">
</head>
<body>
  <div class="panel-container">
    <h2>📋 Panel de Aseguradoras</h2>

    <?php if (isset($_GET['eliminado'])): ?>
      <div class="mensaje-exito">✅ Aseguradora eliminada correctamente.</div>
    <?php endif; ?>

    <?php if (isset($_GET['actualizado'])): ?>
      <div class="mensaje-exito">✅ Aseguradora actualizada correctamente.</div>
    <?php endif; ?>

    <?php if (isset($_GET['creado'])): ?>
      <div class="mensaje-exito">✅ Aseguradora registrada correctamente.</div>
    <?php endif; ?>

    <table class="tabla-aseguradoras">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Domicilio</th>
          <th>CIF</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Persona de contacto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once '../config/database.php';
        $db = Database::conectar();
        $aseguradoras = $db->query("SELECT * FROM aseguradoras")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($aseguradoras as $aseguradora): ?>
          <tr>
            <td><?= htmlspecialchars($aseguradora['nombre']) ?></td>
            <td><?= htmlspecialchars($aseguradora['domicilio']) ?></td>
            <td><?= htmlspecialchars($aseguradora['cif']) ?></td>
            <td><?= htmlspecialchars($aseguradora['telefono']) ?></td>
            <td><?= htmlspecialchars($aseguradora['email']) ?></td>
            <td><?= htmlspecialchars($aseguradora['persona_contacto']) ?></td>
            <td>
              <a href="editar_aseguradora.php?id=<?= $aseguradora['id'] ?>" class="btn editar">✏️ Editar</a>
              <a href="../controllers/EliminarAseguradoraController.php?id=<?= $aseguradora['id'] ?>" class="btn eliminar" onclick="return confirm('¿Estás segura de que quieres eliminar esta aseguradora?')">🗑 Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="botones-panel">
      <a href="form_aseguradoras.php" class="btn nueva">➕ Registrar nueva aseguradora</a>
      <a href="../index.php" class="btn volver">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
