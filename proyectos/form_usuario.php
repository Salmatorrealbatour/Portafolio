<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="../public/css/form_usuario.css">
</head>
<body>
  <main class="form-container">
    <div class="form-wrapper">
      <h2>👤 Crear Usuario</h2>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="mensaje-error"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <form action="../controllers/GuardarUsuarioController.php" method="POST">
        <table class="form-table">
          <tr>
            <td><label for="nombre">Nombre</label></td>
            <td><input type="text" name="nombre" id="nombre" required></td>
          </tr>
          <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" id="email" required></td>
          </tr>
          <tr>
            <td><label for="clave">Clave</label></td>
            <td><input type="password" name="clave" id="clave" required></td>
          </tr>
          <tr>
            <td><label for="rol">Rol</label></td>
            <td>
              <select name="rol" id="rol" required>
                <option value="">Selecciona un rol --</option>
                <option value="admin">Administrador</option>
                <option value="usuario">Usuario</option>
              </select>
            </td>
          </tr>
        </table>
        <button type="submit" class="btn">Guardar usuario</button>
      </form>
      <a href="../index.php" class="volver">← Volver al panel</a>
    </div>
  </main>
</body>
</html>
