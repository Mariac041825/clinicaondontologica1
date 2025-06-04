<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Médico</title>
    <style>
        #frmMedico form {
            font-family: 'Segoe UI', sans-serif;
            padding: 10px;
        }

        #frmMedico label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        #frmMedico input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div id="frmMedico" title="Agregar Nuevo Médico" style="display:none;">
        <form id="agregarMedico">
            <label for="MedDocumento">Documento:</label>
            <input type="text" id="MedDocumento" name="MedDocumento" required>

            <label for="MedNombres">Nombres:</label>
            <input type="text" id="MedNombres" name="MedNombres" required>

            <label for="MedApellidos">Apellidos:</label>
            <input type="text" id="MedApellidos" name="MedApellidos" required>

            <label for="MedContrasena">Contraseña:</label>
            <input type="password" id="MedContrasena" name="MedContrasena" required>
        </form>
    </div>
</body>
</html>
