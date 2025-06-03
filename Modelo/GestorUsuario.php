<?php
class GestorUsuario {
    public function validarUsuario($usuario, $clave, $tipo) {
        $conexion = new Conexion();
        $conexion->abrir();

        // Solo selecciona el usuario y tipo; la clave se verifica con password_verify
        $sql = "SELECT * FROM Usuarios WHERE UsuIdentificacion='$usuario' AND UsuTipo='$tipo'";
        $conexion->consulta($sql);
        $res = $conexion->obtenerResult();

        $conexion->cerrar();

        if ($res->num_rows > 0) {
            $usuarioDB = $res->fetch_assoc();
            if (password_verify($clave, $usuarioDB['UsuContrasena'])) {
                // Retornar el usuario si la contraseña coincide
                return $res;
            }
        }

    
    }

    public function agregarUsuario(Usuario $usuario) {
        $conexion = new Conexion();
        $conexion->abrir();

        $ident = $usuario->obtenerIdentificacion();
        $con = password_hash($usuario->obtenerContrasena(), PASSWORD_DEFAULT); // contraseña segura
        $tip = $usuario->obtenerTipo();

        $sql = "INSERT INTO Usuarios VALUES ('$ident', '$con', '$tip')";
        $conexion->consulta($sql);

        $conexion->cerrar();
    }
}
