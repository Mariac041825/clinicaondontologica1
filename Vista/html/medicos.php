<?php
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <ul id="menu">
            <li><a href="index.php?accion=inicio">Inicio</a></li>
            <li><a href="index.php?accion=asignar">Asignar</a></li>
            <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
            <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
            <li class="activa"><a href="index.php?accion=medicos">Médicos</a></li>
            <li><a href="index.php?accion=cerrarSesion">Cerrar Sesión</a></li>
        </ul>

        <div id="contenido">
            <h2>Gestión de Médicos</h2>

            <!-- Botón para agregar nuevo médico -->
            <a href="#" class="boton a" onclick="mostrarFormularioMedico()">➕ Nuevo Médico</a>

            <?php if (!empty($medicos)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicos as $medico): ?>
                            <tr>
                                <td><?= htmlspecialchars($medico['MedIdentificacion']) ?></td>
                                <td><?= htmlspecialchars($medico['MedNombres']) ?></td>
                                <td><?= htmlspecialchars($medico['MedApellidos']) ?></td>
                                <td>
                                    <a href="#" class="boton editar-medico" data-id="<?= htmlspecialchars($medico['MedIdentificacion']) ?>">Editar</a>
                                </td>
                                <td>
                                    <a class="boton rojo" href="index.php?accion=eliminarmedico&id=<?= htmlspecialchars($medico['MedIdentificacion']) ?>" onclick="return confirm('¿Seguro que deseas eliminar este médico?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay médicos registrados.</p>
            <?php endif; ?>
        </div>

        <!-- Modal para agregar médico -->
        <div id="frmMedico" title="Agregar Nuevo Médico" style="display:none;">
            <form id="agregarMedico">
                <label for="MedDocumento">Documento:</label>
                <input type="text" id="MedDocumento" name="MedDocumento" required>
                <br>
                <label for="MedNombres">Nombres:</label>
                <input type="text" id="MedNombres" name="MedNombres" required>
                <br>
                <label for="MedApellidos">Apellidos:</label>
                <input type="text" id="MedApellidos" name="MedApellidos" required>
                <br>
                <label for="MedContrasena">Contraseña:</label>
                <input type="text" id="MedContrasena" name="MedContrasena" required>
            </form>
        </div>

        <!-- Modal dinámico para editar médico -->
        <div id="ventana-modal" title="Editar Médico" style="display:none;"></div>
    </div>
</body>
</html>
