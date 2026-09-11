<?php
session_start();
require_once '../config/database.php';

// Validar sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Conectar y obtener averías
$db = Database::conectar();
$averias = $db->query("SELECT * FROM averias ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Averías registradas</title>
  <link rel="stylesheet" href="../public/css/panel_averias.css">
</head>
<body>
  <div class="panel-container">
    <h2>🔧 Averías registradas</h2>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="mensaje-exito"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table class="tabla">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripción</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($averias)): ?>
          <?php foreach ($averias as $a): ?>
            <tr>
              <td><?= $a['id'] ?></td>
              <td><?= htmlspecialchars($a['descripcion']) ?></td>
              <td>
                <?php if (!empty($a['imagen'])): ?>
                  <img src="../public/img/averias/<?= $a['imagen'] ?>" alt="Imagen avería"
                       style="width:100px;height:100px;object-fit:cover;border-radius:6px;box-shadow:0 0 4px rgba(0,0,0,0.2);display:block;margin:0 auto;">
                <?php else: ?>
                  Sin imagen
                <?php endif; ?>
              </td>
              <td>
                <form action="../controllers/EliminarAveriaController.php" method="GET" onsubmit="return confirm('¿Eliminar esta avería?');">
                  <input type="hidden" name="id" value="<?= $a['id'] ?>">
                  <button type="submit" class="btn eliminar">🗑 Eliminar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">No hay averías registradas.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="acciones">
      <a href="form_averias.php" class="btn crear">➕ Registrar nueva avería</a>
      <a href="../index.php" class="btn volver">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
