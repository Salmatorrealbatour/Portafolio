<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso al sistema</title>
  <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
  <div class="login-container">
    <h2>Acceso al sistema</h2>

    <form id="loginForm">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Contraseña:</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Entrar</button>
    </form>

    <div id="error-message"></div>
  </div>

  <script src="../public/js/login.js"></script>
</body>
</html>
