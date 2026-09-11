<?php
session_start();
require_once 'config/database.php';
$db = Database::conectar();

if (!isset($_SESSION['usuario'])) {
    header("Location: views/login.php");
    exit;
}
$totalUsuarios = $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$totalAseguradoras = $db->query("SELECT COUNT(*) FROM aseguradoras")->fetchColumn();
$totalAsegurados = $db->query("SELECT COUNT(*) FROM asegurados")->fetchColumn();
$totalAverias = $db->query("SELECT COUNT(*) FROM averias")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Inicio</title>
  <link rel="stylesheet" href="public/css/index.css">
</head>
<body>
  <div class="panel-container">
    <div class="usuario-info">
      <h1>Bienvenida, <span><?= $_SESSION['usuario']['nombre'] ?></span></h1>
      <p class="rol">(<?= $_SESSION['usuario']['rol'] ?>)</p>
    </div>

    <h2>📊 Estadísticas del sistema</h2>

    <table class="tabla-estadisticas">
      <thead>
        <tr>
          <th>Módulo</th>
          <th>Registros</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Aseguradoras</td>
          <td><?=$totalAseguradoras?></td>
        </tr>
        <tr>
          <td>Asegurados</td>
          <td><?=$totalAsegurados?></td>
        </tr>
        <tr>
          <td>Averías</td>
          <td><?=$totalAverias?></td>
        </tr>
        <tr> 
            <td>Usuarios</td>
            <td><?=$totalUsuarios?></td>
        </tr>
      </tbody>
    </table>

    <nav>
      <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
        <a href="views/form_usuario.php">Crear usuario</a>
      <?php endif; ?>
      <a href="views/form_aseguradoras.php">Registrar Aseguradoras</a>
      <a href="views/form_asegurado.php">Registrar Asegurados</a>
      <a href="views/form_averias.php">Registrar Averías</a>
      <a href="views/form_reparacion.php">Registrar Reparaciones</a>
      <a href="views/panel_aseguradoras.php">Panel Aseguradoras</a>
      <a href="views/panel_asegurados.php"> Panel Asegurado</a>
       <a href="views/panel_usuarios.php">Panel de usuarios</a>
       <a href="views/panel_averias.php">Panel Averias</a>
       <a href="views/panel_reparaciones.php">Panel Reparaciones</a>
      <a href="views/login.php" class="logout">Cerrar sesión</a>

    </nav>
  </div>
</body>
</html>
