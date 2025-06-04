<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script src="Vista/jquery/jquery-3.7.1.min.js"></script>
    <script src="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="Vista/js/script.js"></script>
</head>
<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>

        <?php if (isset($_SESSION["rol"])): ?>
        <?php $accion = isset($_GET["accion"]) ? $_GET["accion"] : "inicio"; ?>
        <ul id="menu">
            <li class="<?= $accion == 'inicio' ? 'activa' : '' ?>"><a href="index.php">Inicio</a></li>
            <?php
                if ($_SESSION["rol"] == "paciente") {
                    echo '<li class="'.($accion=='consultar'?'activa':'').'"><a href="index.php?accion=consultar">Consultar Cita</a></li>';
                    echo '<li class="'.($accion=='cancelar'?'activa':'').'"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>';
                } elseif ($_SESSION["rol"] == "medico") {
                    echo '<li class="'.($accion=='asignar'?'activa':'').'"><a href="index.php?accion=asignar">Asignar</a></li>';
                    echo '<li class="'.($accion=='consultar'?'activa':'').'"><a href="index.php?accion=consultar">Consultar Cita</a></li>';
                    echo '<li class="'.($accion=='cancelar'?'activa':'').'"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>';
                } elseif ($_SESSION["rol"] == "administrador") {
                    echo '<li class="'.($accion=='asignar'?'activa':'').'"><a href="index.php?accion=asignar">Asignar</a></li>';
                    echo '<li class="'.($accion=='consultar'?'activa':'').'"><a href="index.php?accion=consultar">Consultar Cita</a></li>';
                    echo '<li class="'.($accion=='cancelar'?'activa':'').'"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>';
                    echo '<li class="'.($accion=='medicos'?'activa':'').'"><a href="index.php?accion=medicos">Gestión de Médicos</a></li>';
                }
            ?>
            <li><a href="index.php?accion=cerrarSesion">Cerrar Sesión</a></li>
        </ul>
        <?php else: ?>
            <p>Acceso no autorizado. <a href="index.php">Iniciar sesión</a></p>
        <?php endif; ?>

        <div id="contenido">
            <h2>Título de página</h2>
            <p>Contenido de la página</p>
        </div>
    </div>
</body>
</html>
