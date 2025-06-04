<?php
if (!isset($_SESSION["rol"]) || ($_SESSION["rol"] != "medico" && $_SESSION["rol"] != "administrador")) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Cita - Sistema de Gestión Odontológica</title>
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

    <ul id="menu">
        <li><a href="index.php?accion=inicio">Inicio</a></li>
        <li class="activa"><a href="index.php?accion=asignar">Asignar</a></li>
        <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
        <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
        <?php if ($_SESSION["rol"] == "administrador"): ?>
            <li><a href="index.php?accion=medicos">Médicos</a></li>
        <?php endif; ?>
        <li><a href="index.php?accion=cerrarSesion">Cerrar Sesión</a></li>
    </ul>

    <div id="contenido">
        <h2>Asignar Cita</h2>
        <form id="frmasignar" action="index.php?accion=guardarCita" method="post">
            <table>
                <tr>
                    <td>Documento del paciente</td>
                    <td><input type="text" name="asignarDocumento" id="asignarDocumento" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="button" class="boton" value="Consultar" onclick="consultarPaciente()">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><div id="paciente"></div></td>
                </tr>
                <tr>
                    <td>Médico</td>
                    <td>
                        <select id="medico" name="medico" onchange="cargarHoras()" required>
                            <option value="-1">---Seleccione el Médico---</option>
                            <?php while ($fila = $result->fetch_object()): ?>
                                <option value="<?= $fila->MedIdentificacion ?>">
                                    <?= $fila->MedIdentificacion . " - " . $fila->MedNombres . " " . $fila->MedApellidos ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td><input type="date" id="fecha" name="fecha" onchange="cargarHoras()" required></td>
                </tr>
                <tr>
                    <td>Hora</td>
                    <td>
                        <select id="hora" name="hora" onmousedown="seleccionarHora()" required>
                            <option value="-1">---Seleccione la hora---</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Consultorio</td>
                    <td>
                        <select id="consultorio" name="consultorio" required>
                            <option value="-1">---Seleccione el Consultorio---</option>
                            <?php while ($fila = $result2->fetch_object()): ?>
                                <option value="<?= $fila->ConNumero ?>">
                                    <?= $fila->ConNumero . " - " . $fila->ConNombre ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="boton" value="Enviar">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Modal para agregar paciente -->
<div id="frmPaciente" title="Agregar Nuevo Paciente" style="display:none;">
    <form id="agregarPaciente">
        <table>
            <tr>
                <td>Documento</td>
                <td><input type="text" name="PacDocumento" id="PacDocumento" required></td>
            </tr>
            <tr>
                <td>Nombres</td>
                <td><input type="text" name="PacNombres" id="PacNombres" required></td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td><input type="text" name="PacApellidos" id="PacApellidos" required></td>
            </tr>
            <tr>
                <td>Fecha de Nacimiento</td>
                <td><input type="date" name="PacNacimiento" id="PacNacimiento" required></td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td>
                    <select id="PacSexo" name="PacSexo" required>
                        <option value="">--Seleccione el sexo--</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="PacContrasena" id="PacContrasena" required></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
