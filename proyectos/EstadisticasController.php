<?php
session_start();
require_once '../config/database.php';

$db = Database::conectar();

$datos = [
    'Usuarios' => $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn(),
    'Admins' => $db->query("SELECT COUNT(*) FROM usuarios WHERE rol = 'admin'")->fetchColumn(),
    'Técnicos' => $db->query("SELECT COUNT(*) FROM usuarios WHERE rol = 'tecnico'")->fetchColumn(),
    'Gestores' => $db->query("SELECT COUNT(*) FROM usuarios WHERE rol = 'gestor'")->fetchColumn(),
    'Aseguradoras' => $db->query("SELECT COUNT(*) FROM aseguradoras")->fetchColumn(),
    'Asegurados' => $db->query("SELECT COUNT(*) FROM asegurados")->fetchColumn(),
    'Averías' => $db->query("SELECT COUNT(*) FROM averias")->fetchColumn(),
    'Reparaciones' => $db->query("SELECT COUNT(*) FROM reparaciones")->fetchColumn()
];

echo json_encode($datos);
