<?php if ($result->num_rows > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre Completo</th>
                <th>Sexo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $result->fetch_object()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila->PacIdentificacion) ?></td>
                    <td><?= htmlspecialchars($fila->PacNombres . " " . $fila->PacApellidos) ?></td>
                    <td><?= htmlspecialchars($fila->PacSexo) ?></td>
                    <td><a href="#" class="boton" onclick="verCita('<?= $fila->PacIdentificacion ?>')">Ver</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>El paciente no existe en la base de datos.</p>
    <input type="button" class="boton" id="ingPaciente" value="Ingresar Paciente" onclick="mostrarFormulario()">
<?php endif; ?>
