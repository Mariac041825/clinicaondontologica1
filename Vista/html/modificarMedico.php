<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Médico</title>
    <style>
        form {
            font-family: 'Segoe UI', sans-serif;
            padding: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #0075ff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #005ecb;
        }
    </style>
</head>
<body>
    <form method="POST" action="index.php?accion=guardarEdicion&id=<?= htmlspecialchars($medico['MedIdentificacion']) ?>">

        <input type="hidden" name="id" value="<?= htmlspecialchars($medico['MedIdentificacion']) ?>">

        <label for="nombres">Nombre:</label>
        <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($medico['MedNombres']) ?>" required>

        <label for="apellidos">Apellido:</label>
        <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($medico['MedApellidos']) ?>" required>

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>
