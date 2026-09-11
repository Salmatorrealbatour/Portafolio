<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';
$db = Database::conectar();
$usuarios = $db->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios Registrados</title>
  <link rel="stylesheet" href="../public/css/panel_usuario.css">
</head>
<body>
  <div class="panel-container">
    <h2>👥 Usuarios Registrados</h2>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="mensaje-exito"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table class="tabla-usuarios">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Clave</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nombre']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>****</td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>
             <form action="../controllers/EliminarUsuarioController.php" method="GET">

                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button type="submit" class="btn eliminar">🗑 Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="acciones">
      <a href="../index.php" class="btn volver">← Volver al inicio</a>
      <a href="form_usuario.php" class="btn crear">➕ Crear nuevo usuario</a>
    </div>
  </div>
</body>
</html>
