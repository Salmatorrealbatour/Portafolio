<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Aseguradora</title>
  <link rel="stylesheet" href="../public/css/form_aseguradora.css">
</head>
<body>
  <main class="form-container">
    <div class="form-wrapper">
      <h2>🏢 Registrar nueva aseguradora</h2>
      <form action="../controllers/GuardarAseguradoraController.php" method="POST">
        <table class="form-table">
          <tr>
            <td><label for="nombre">Nombre</label></td>
            <td><input type="text" name="nombre" id="nombre" required></td>
          </tr>
          <tr>
            <td><label for="domicilio">Domicilio</label></td>
            <td><input type="text" name="domicilio" id="domicilio" required></td>
          </tr>
          <tr>
            <td><label for="cif">CIF</label></td>
            <td><input type="text" name="cif" id="cif" required></td>
          </tr>
          <tr>
            <td><label for="telefono">Teléfono</label></td>
            <td><input type="text" name="telefono" id="telefono" required></td>
          </tr>
          <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" id="email" required></td>
          </tr>
          <tr>
            <td><label for="contacto">Persona de contacto</label></td>
            <td><input type="text" name="contacto" id="contacto" required></td>
          </tr>
        </table>
        <button type="submit" class="btn">Registrar aseguradora</button>
      </form>
      <a href="../index.php" class="volver">← Volver al menú</a>
    </div>
  </main>
</body>
</html>
