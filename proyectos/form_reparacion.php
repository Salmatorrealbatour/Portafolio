<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Reparaciones</title>
  <link rel="stylesheet" href="../public/css/reparaciones_form.css">
</head>
<body>
  <div class="form-container">
    <h2>Registrar Reparación</h2>
    <?php if (isset($_GET['success'])): ?>
  <div class="mensaje-guardado" style="color: green; margin-bottom: 10px;">
    ✅ Reparación guardada con éxito.
  </div>
<?php elseif (isset($_GET['error'])): ?>
  <div class="mensaje-guardado" style="color: red; margin-bottom: 10px;">
    <?php
      switch ($_GET['error']) {
        case 'datos_incompletos':
          echo '⚠️ Por favor, completa todos los campos.';
          break;
        case 'averia_no_encontrada':
          echo '❌ La avería indicada no existe.';
          break;
        case 'bd':
          echo '🚫 Error al conectar con la base de datos.';
          break;
        default:
          echo '❌ Error desconocido.';
      }
    ?>
  </div>
<?php endif; ?>
<form action="../controllers/GuardarReparacionController.php" method="POST">
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="3" required></textarea>

      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="fecha" required>

      <label for="tecnico">Técnico:</label>
      <input type="text" id="tecnico" name="tecnico" required>

      <label for="costo">Costo (€):</label>
      <input type="number" id="costo" name="costo" step="0.01" required>

      <label for="averia_id">ID de Avería:</label>
      <input type="number" id="averia_id" name="averia_id" required>

      <button type="submit">Guardar</button>
    </form>

    <div class="volver-container">
      <a href="../index.php" class="btn-volver">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
