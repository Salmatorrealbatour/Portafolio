<?php
session_start();
header('Content-Type: application/json');
require_once '../config/database.php';

$db = Database::conectar();

$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo json_encode(['success' => false, 'error' => 'Completa todos los campos.']);
    exit;
}

$stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($password, $usuario['password'])) {
    echo json_encode(['success' => false, 'error' => 'Credenciales incorrectas.']);
    exit;
}

$_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'nombre' => $usuario['nombre'],
    'email' => $usuario['email'],
    'rol' => $usuario['rol']
];

echo json_encode(['success' => true]);
