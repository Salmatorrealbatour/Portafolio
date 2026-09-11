<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = 'No autenticado.';
    header('Location: ../views/form_averias.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST['descripcion'] ?? '');
    $fecha = $_POST['fecha'] ?? '';
    $asegurado = $_POST['asegurado'] ?? '';
    $aseguradora = $_POST['aseguradora'] ?? '';

    if (!$descripcion || !$fecha || !$asegurado || !$aseguradora || !isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = 'Todos los campos son obligatorios, incluida la imagen.';
        header('Location: ../views/form_averias.php');
        exit;
    }

    $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
    $rutaDestino = __DIR__ . '/../public/img/averias/' . $nombreArchivo;

    if (!is_dir(dirname($rutaDestino))) {
        mkdir(dirname($rutaDestino), 0777, true);
    }

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
        $_SESSION['error'] = 'No se pudo guardar la imagen.';
        header('Location: ../views/form_averias.php');
        exit;
    }

    try {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO averias (descripcion, fecha, asegurado_id, aseguradora_id, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$descripcion, $fecha, $asegurado, $aseguradora, $nombreArchivo]);

        $_SESSION['success'] = 'Se guardó con éxito.';
        header('Location: ../views/panel_averias.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al registrar avería: ' . $e->getMessage();
        header('Location: ../views/form_averias.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Acceso inválido.';
    header('Location: ../views/form_averias.php');
    exit;
}
