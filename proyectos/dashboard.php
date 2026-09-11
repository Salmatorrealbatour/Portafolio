<?php
session_start();

// Verificamos si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$nombre = $_SESSION['usuario']['nombre_usuario'];


?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenida</title>
</head>
<body>
    <h2>¡Hola, <?php echo htmlspecialchars($nombre);
<a href="panel_aseguradoras.php"><button>Ver aseguradoras</button></a>
<a href="panel_asegurados.php"><button>Ver asegurados</button></a>
<a href="panel_averias.php"><button>Ver averías</button></a>
 ?>!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
