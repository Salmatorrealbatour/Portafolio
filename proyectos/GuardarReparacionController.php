<?php
require_once '../config/database.php';

try {
    $db = Database::conectar();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recoger datos del formulario
    $descripcion = trim($_POST['descripcion'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $tecnico = trim($_POST['tecnico'] ?? '');
    $costo = trim($_POST['costo'] ?? '');
    $averia_id = trim($_POST['averia_id'] ?? '');

    // Validación básica
    if ($descripcion && $fecha && $tecnico && $costo && $averia_id) {
        // Validar que avería exista (opcional pero recomendable)
        $check = $db->prepare("SELECT id FROM averias WHERE id = ?");
        $check->execute([$averia_id]);

        if ($check->rowCount() > 0) {
            // Insertar reparación
            $stmt = $db->prepare("INSERT INTO reparaciones (descripcion, fecha, tecnico, costo, averia_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$descripcion, $fecha, $tecnico, $costo, $averia_id]);

            // Redirige con mensaje de éxito
            header('Location: ../views/form_reparacion.php?success=1');
            exit;
        } else {
            // Avería no existe
            header('Location: ../views/form_reparacion.php?error=averia_no_encontrada');
            exit;
        }
    } else {
        // Datos incompletos
        header('Location: ../views/form_reparacion.php?error=datos_incompletos');
        exit;
    }
} catch (PDOException $e) {
    // Puedes guardar el error en un log si lo deseas
    error_log("Error en la base de datos: " . $e->getMessage());

    // Redirige con mensaje de error
    header('Location: ../views/form_reparacion.php?error=bd');
    exit;
}
