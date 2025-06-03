<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link href="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <script src="Vista/jquery/jquery-3.7.1.min.js" type="text/javascript"></script>
    <script src="Vista/jquery/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>
    <script src="Vista/js/script.js" type="text/javascript"></script>
</head>

<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>
        <ul id="menu">
            <li><a href="index.php?accion=inicio">Inicio</a></li>
            <li><a href="index.php?accion=asignar">Asignar</a> </li>
            <li><a href="index.php?accion=consultar">Consultar Cita</a> </li>
            <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
            <li><a href="index.php?accion=medicos">Medicos</a> </li>
        </ul>
        <div id="contenido">
            <tbody>

<a href="#" class="boton a" onclick="mostrarFormularioMedico()">Nuevo Médico</a>
                <?php
                if (!empty($medicos)) {




                    echo "<table>";
                    echo '<tr>';
                    echo "<td>" . 'Identificacion ' . "</td>";
                    echo  "<td>" . "Nombre     " . "</td>";
                    echo   "<td>" . 'Apellidos  ' . "</td>";
                    echo   "<td class='text_modi' >" . 'modificar ' . "</td>";
                    echo   "<td>" . 'eliminar  ' . "</td>";
                    echo '</tr>';

                    for ($i = 0; $i < count($medicos); $i++) {


                        echo "<tr>";
                        echo "<td>" . ($medicos[$i]['MedIdentificacion']) . "   </td>";
                        echo "<td>" . ($medicos[$i]['MedNombres']) . "</td>";
                        echo "<td>" . ($medicos[$i]['MedApellidos']) . "   </td>";

                        echo '<td><a class="boton editar-medico" data-id="' . $medicos[$i]['MedIdentificacion'] . '" href="#">Editar</a></td>';


                        echo '<td><a class="boton rojo" href="index.php?accion=eliminarmedico&id=' . $medicos[$i]['MedIdentificacion'] . '" onclick="return confirm(\'¿Seguro que deseas eliminar este médico?\');">Eliminar</a></td>';


                        echo "</tr>" . '<hr>';
                    }
                    echo "</table> ";
                } else {
                    echo '<tr><td colspan="3">No hay médicos registrados.</td></tr>';
                }
                ?>

            </tbody>

        </div>
        <div id="frmMedico" title="Agregar Nuevo Médico" style="display:none;">
            <form id="agregarMedico">
                <label for="MedDocumento">Documento:</label>
                <input type="text" id="MedDocumento" name="MedDocumento"><br>
                <label for="MedNombres">Nombres:</label>
                <input type="text" id="MedNombres" name="MedNombres"><br>
                <label for="MedApellidos">Apellidos:</label>
                <input type="text" id="MedApellidos" name="MedApellidos"><br>
            </form>
        </div>
        <div id="ventana-modal" title="Editar Médico" style="display:none;"></div>
    </div>
</body>


</html>