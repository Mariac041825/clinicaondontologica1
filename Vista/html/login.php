<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #4db8ff,rgb(42, 83, 155));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: #fff;
            padding: 35px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color:rgb(142, 183, 204);
        }

        .login-container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            background-color: #005580;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #004466;
        }

        .login-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007acc;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="index.php?accion=validarLogin" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <label for="tipoUsuario">Tipo de Usuario:</label>
        <select name="tipoUsuario" id="tipoUsuario" required>
            <option value="paciente">Paciente</option>
            <option value="medico">Médico</option>
            <option value="admin">Administrador</option>
        </select>

        <input type="submit" value="Ingresar">
    </form>

    <a href="index.php?accion=registroPaciente">¿No tienes cuenta? Regístrate</a>
    <a href="index.php?accion=recuperarContrasena">¿Olvidaste tu contraseña?</a>
</div>

</body>
</html>
