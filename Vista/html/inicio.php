<?php
if (!isset($_SESSION["rol"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
</head>
<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>

        <!-- Menú dinámico según el rol -->
        <ul id="menu">
            <li><a href="index.php?accion=inicio">Inicio</a></li>

            <?php if ($_SESSION["rol"] == "paciente"): ?>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>

            <?php elseif ($_SESSION["rol"] == "medico"): ?>
                <li><a href="index.php?accion=asignar">Asignar</a></li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>

            <?php elseif ($_SESSION["rol"] == "administrador"): ?>
                <li><a href="index.php?accion=asignar">Asignar</a></li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
                <li><a href="index.php?accion=medicos">Médicos</a></li>
            <?php endif; ?>

            <li><a href="index.php?accion=cerrarSesion">Cerrar Sesión</a></li>
        </ul>

        <!-- Contenido principal -->
        <div id="contenido">
            <h2>Bienvenido, <?= ucfirst($_SESSION["rol"]) ?></h2>
            <p>El Sistema de Gestión Odontológica permite administrar la información de los
                pacientes, médicos y citas a través de una interfaz web fácil de usar.</p>
            <p>Acciones disponibles según su rol:</p>
            <ul>
                <?php if ($_SESSION["rol"] == "paciente"): ?>
                    <li>Consultar cita</li>
                    <li>Cancelar cita</li>
                <?php elseif ($_SESSION["rol"] == "medico"): ?>
                    <li>Asignar cita</li>
                    <li>Consultar cita</li>
                    <li>Cancelar cita</li>
                <?php elseif ($_SESSION["rol"] == "administrador"): ?>
                    <li>Asignar cita</li>
                    <li>Consultar cita</li>
                    <li>Cancelar cita</li>
                    <li>Gestión de médicos</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>
</html>
