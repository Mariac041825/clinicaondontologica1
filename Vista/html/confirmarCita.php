<?php
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}

$fila = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información de la Cita</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
</head>
<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>

        <ul id="menu">
            <li><a href="index.php">Inicio</a></li>
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

        <div id="contenido">
            <h2>Información de la Cita</h2>
            <table class="table">
                <tr><th colspan="2">Datos del Paciente</th></tr>
                <tr>
                    <td>Documento</td>
                    <td><?= htmlspecialchars($fila->PacIdentificacion) ?></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><?= htmlspecialchars($fila->PacNombres . ' ' . $fila->PacApellidos) ?></td>
                </tr>

                <tr><th colspan="2">Datos del Médico</th></tr>
                <tr>
                    <td>Documento</td>
                    <td><?= htmlspecialchars($fila->MedIdentificacion) ?></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><?= htmlspecialchars($fila->MedNombres . ' ' . $fila->MedApellidos) ?></td>
                </tr>

                <tr><th colspan="2">Datos de la Cita</th></tr>
                <tr>
                    <td>Número</td>
                    <td><?= htmlspecialchars($fila->CitNumero) ?></td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td><?= htmlspecialchars($fila->CitFecha) ?></td>
                </tr>
                <tr>
                    <td>Hora</td>
                    <td><?= htmlspecialchars($fila->CitHora) ?></td>
                </tr>
                <tr>
                    <td>Número de Consultorio</td>
                    <td><?= htmlspecialchars($fila->ConNombre) ?></td>
                </tr>
                <tr>
                    <td>Estado</td>
                    <td><?= htmlspecialchars($fila->CitEstado) ?></td>
                </tr>
                <tr>
                    <td>Observaciones</td>
                    <td><?= htmlspecialchars($fila->CitObservaciones) ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
