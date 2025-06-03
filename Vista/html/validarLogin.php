<?php
require_once 'Modelo/Conexion.php';
require_once 'Modelo/GestorUsuario.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$tipo = $_POST['tipoUsuario'];

$gestor = new GestorUsuario();
$resultado = $gestor->validarUsuario($usuario, $contrasena, $tipo);

if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] = $tipo;
    header("Location: index.php");
} else {
    echo "<script>alert('Credenciales incorrectas'); window.location='login.php';</script>";
}
