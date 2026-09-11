<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar nuevo asegurado</title>
  <link rel="stylesheet" href="../public/css/form_asegurado.css">
</head>
<body>
  <div class="form-wrapper">
    <h2>🧍 Registrar nuevo asegurado</h2>
   <?php if (isset($_SESSION['success'])): ?>
  <div class="mensaje-exito"><?= $_SESSION['success'] ?></div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
  <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

    <form action="../controllers/AseguradoController.php" method="POST">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
      </div>
      <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" required>
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" required>
      </div>
      <div class="form-group">
        <label for="domicilio_reparacion">Domicilio de reparación</label>
        <input type="text" name="domicilio_reparacion" id="domicilio_reparacion" required>
      </div>
      <button type="submit" class="btn">Guardar asegurado</button>
    </form>
    <a href="../index.php" class="volver">← Volver al menú</a>
  </div>
</body>
</html>
