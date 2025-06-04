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

        <!-- Menú dinámico según el rol del usuario -->
        <ul id="menu">
            <li><a href="index.php?accion=inicio">Inicio</a></li>

            <?php if ($_SESSION["rol"] == "paciente"): ?>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li class="activa"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
            <?php elseif ($_SESSION["rol"] == "medico"): ?>
                <li><a href="index.php?accion=asignar">Asignar</a></li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li class="activa"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
            <?php elseif ($_SESSION["rol"] == "administrador"): ?>
                <li><a href="index.php?accion=asignar">Asignar</a></li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li class="activa"><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
                <li><a href="index.php?accion=medicos">Médicos</a></li>
            <?php endif; ?>

            <li><a href="index.php?accion=cerrarSesion">Cerrar Sesión</a></li>
        </ul>

        <!-- Contenido principal -->
        <div id="contenido">
            <h2>Cancelar Cita</h2>
            <form id="frmcancelar" onsubmit="event.preventDefault(); cancelarConsultar();">
                <table class="table">
                    <tr>
                        <td>Documento del Paciente</td>
                        <td>
                            <input type="text" name="cancelarDocumento" id="cancelarDocumento" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <input type="submit" value="Consultar" class="boton">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="paciente3"></div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
