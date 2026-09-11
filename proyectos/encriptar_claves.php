<?php
session_start();
require_once '../config/database.php';

$db = Database::conectar();

// Solo permitir acceso a administradores
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "⛔ Acceso denegado. Solo administradores pueden ejecutar este script.";
    exit;
}

// Obtener todos los usuarios
$usuarios = $db->query("SELECT id, password FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>🔐 Encriptación de contraseñas</h2><ul>";

foreach ($usuarios as $usuario) {
    $id = $usuario['id'];
    $clave = $usuario['password'];

    // Verificar si ya está encriptada (los hash de password_hash comienzan con $2y$)
    if (strpos($clave, '$2y$') !== 0) {
        // Encriptar y actualizar
        $clave_segura = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        $stmt->execute([$clave_segura, $id]);

        echo "<li>✅ Usuario ID $id: contraseña encriptada.</li>";
    } else {
        echo "<li>🔒 Usuario ID $id: ya tiene contraseña segura.</li>";
    }
}

echo "</ul><p>🎉 Proceso completado.</p>";
