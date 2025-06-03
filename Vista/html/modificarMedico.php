<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="index.php?accion=guardarEdicion&id=<?= $medico['MedIdentificacion'] ?>">

    <input type="hidden" name="id" value="<?= $medico['MedIdentificacion'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombres" value="<?= $medico['MedNombres'] ?>">
    <br><br>

    <label>Apellido:</label>
    <input type="text" name="apellidos" value="<?= $medico['MedApellidos'] ?>">


    <input type="submit" value="Guardar cambios">
           
</form>
</body>
</html>