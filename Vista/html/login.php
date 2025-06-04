<?php
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Clínica Odontológica</title>
    <link rel="stylesheet" href="Vista/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Bienvenido</h2>
        <p>Inicia sesión para acceder al sistema</p>

        <?php if ($error == 1): ?>
            <p class="error">⚠️ Credenciales incorrectas. Intenta nuevamente.</p>
        <?php endif; ?>

        <form action="index.php?accion=validarLogin" method="POST">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="">Seleccione su rol</option>
                <option value="paciente" <?= (isset($_POST['rol']) && $_POST['rol'] == 'paciente') ? 'selected' : '' ?>>Paciente</option>
                <option value="medico" <?= (isset($_POST['rol']) && $_POST['rol'] == 'medico') ? 'selected' : '' ?>>Medico</option>
                <option value="administrador" <?= (isset($_POST['rol']) && $_POST['rol'] == 'administrador') ? 'selected' : '' ?>>Administrador</option>
            </select>

            <label for="identificacion">Identificación:</label>
            <input type="text" id="identificacion" name="identificacion" required aria-label="Identificación">

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required aria-label="Contraseña">

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
