<?php
session_start();
require_once '../config/database.php';

// Validar sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Validar ID recibido
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
  $_SESSION['error'] = 'ID no recibido.';
  header('Location: panel_aseguradoras.php');
  exit;
}

// Obtener datos de la aseguradora
$db = Database::conectar();
$stmt = $db->prepare("SELECT * FROM aseguradoras WHERE id = ?");
$stmt->execute([$id]);
$aseguradora = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aseguradora) {
  $_SESSION['error'] = 'Aseguradora no encontrada.';
  header('Location: panel_aseguradoras.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar aseguradora</title>
  <link rel="stylesheet" href="../public/css/form_aseguradora.css">
</head>
<body>
  <div class="form-container">
    <h2>✏️ Editar aseguradora</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="../controllers/EditarAseguradoraController.php" method="POST">
      <input type="hidden" name="id" value="<?= $aseguradora['id'] ?>">

      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($_SESSION['form_nombre'] ?? $aseguradora['nombre']) ?>" required>

      <label for="domicilio">Domicilio:</label>
      <input type="text" name="domicilio" id="domicilio" value="<?= htmlspecialchars($_SESSION['form_domicilio'] ?? $aseguradora['domicilio']) ?>" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($_SESSION['form_telefono'] ?? $aseguradora['telefono']) ?>" required>

      <div class="acciones">
        <button type="submit" class="btn guardar">💾 Guardar cambios</button>
        <a href="panel_aseguradoras.php" class="btn volver">← Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>
