<?php if ($result->num_rows > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $result->fetch_object()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila->CitNumero) ?></td>
                    <td><?= htmlspecialchars($fila->CitFecha) ?></td>
                    <td><?= htmlspecialchars($fila->CitHora) ?></td>
                    <td>
                        <a href="index.php?accion=verCita&numero=<?= urlencode($fila->CitNumero) ?>" class="boton">Ver</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>El paciente no tiene citas asignadas.</p>
<?php endif; ?>
