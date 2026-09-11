<?php
session_start();
require_once '../config/database.php';
$db = Database::conectar();

$id = $_GET['id'];
$reparacion = $db->prepare("SELECT * FROM reparaciones WHERE id = :id");
$reparacion->execute([':id' => $id]);
$r = $reparacion->fetch();
?>

<h2>Editar reparación</h2>
<form method="POST" action="../controllers/ActualizarReparacionController.php">
    <input type="hidden" name="id" value="<?= $r['id'] ?>">

    <label>Descripción:</label><br>
    <textarea name="descripcion"><?= $r['descripcion'] ?></textarea><br><br>

    <label>Técnico:</label><br>
    <input type="text" name="tecnico" value="<?= $r['tecnico'] ?>"><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" value="<?= $r['fecha'] ?>"><br><br>

    <label>Costo (€):</label><br>
    <input type="number" step="0.01" name="costo" value="<?= $r['costo'] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>
