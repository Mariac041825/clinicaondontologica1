<?php
class Controlador
{
    public function verPagina($ruta)
    {
        require_once $ruta;
    }

    public function agregarCita($doc, $med, $fec, $hor, $con)
    {
        $cita = new Cita(
            null,
            $fec,
            $hor,
            $doc,
            $med,
            $con,
            "Solicitada",
            "Ninguna"
        );

        $gestorCita = new GestorCita();
        $id = $gestorCita->agregarCita($cita);
        $result = $gestorCita->consultarCitaPorId($id);

        require_once 'Vista/html/confirmarCita.php';
    }

    public function consultarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);

        require_once 'Vista/html/consultarCitas.php';
    }

    public function cancelarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);

        require_once 'Vista/html/cancelarCitas.php';
    }

    public function consultarPaciente($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPaciente($doc);

        require_once 'Vista/html/consultarPaciente.php';
    }

    public function agregarPaciente($doc, $nom, $ape, $fec, $sex)
    {
        $paciente = new Paciente($doc, $nom, $ape, $fec, $sex);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente($paciente);

        if ($registros > 0) {
            echo "Se insertó el paciente con éxito";
        } else {
            echo "Error al grabar el paciente";
        }
    }

    public function cargarAsignar()
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicos();
        $result2 = $gestorCita->consultarConsultorios();

        require_once 'Vista/html/asignar.php';
    }

    public function consultarHorasDisponibles($medico, $fecha)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarHorasDisponibles($medico, $fecha);

        require_once 'Vista/html/consultarHoras.php';
    }

    public function verCita($cita)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorId($cita);

        require_once 'Vista/html/confirmarCita.php';
    }

    public function confirmarCancelarCita($cita)
    {
        $gestorCita = new GestorCita();
        $registros = $gestorCita->cancelarCita($cita);

        if ($registros > 0) {
            echo "La cita se ha cancelado con éxito";
        } else {
            echo "Hubo un error al cancelar la cita";
        }
    }

    public function verMedicos()
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $medicos = $conexion->obtenerMedicos();
            $conexion->cerrar();
        } else {
            $medicos = [];
        }

        require_once 'Vista/html/medicos.php';
    }

    public function modificarMedico($id)
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $medico = $conexion->obtenerMedicoPorId($id);
            $conexion->cerrar();
        } else {
            $medico = null;
        }

        require_once 'Vista/html/modificarMedico.php';
    }

    public function guardarcambios($id, $nombres, $apellidos)
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $conexion->cambiosmedico($id, $nombres, $apellidos);
            $conexion->cerrar();
        }

        header("Location: index.php?accion=medicos");
    }

    public function eliminarmedico($id)
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $conexion->eliminarmedicos($id);
            $conexion->cerrar();
        }

        header("Location: index.php?accion=medicos");
    }
    public function consultarUsuario($usuario,$contrasenia,$tipoUsuario){
        $conexion = new Conexion();
        $conexion->abrir();
        $gestorCita= new GestorCita();
        $result= $gestorCita->validarLoginUsuario($usuario,$contrasenia,$tipoUsuario);
        if($result>0){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $tipoUsuario;
            require_once("index.php");
        }else{
            echo "El Usuario no existe";
        }
    }
    public function agregarmedico($doc, $nom, $ape)
    {
        $medico = new Medico($doc, $nom, $ape);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarmedico($medico);

        if ($registros > 0) {
            echo "Se insertó el Médico con éxito";
        } else {
            echo "Error al grabar el Médico";
        }
    }

    public function validarLogin($usuario, $clave, $tipo)
    {
        $gestor = new GestorUsuario();
        $resultado = $gestor->validarUsuario($usuario, $clave, $tipo);

        if ($resultado->num_rows > 0) {
            header("Location: index.php");
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location='index.php?accion=login';</script>";
        }
    }

    public function guardarPacienteRegistro($ident, $nom, $ape, $fecha, $sexo)
    {
        $paciente = new Paciente($ident, $nom, $ape, $fecha, $sexo);
        $gestor = new GestorCita();
        $gestor->agregarPaciente($paciente);

        $usuario = new Usuario($ident, $ident, 'paciente'); // Contraseña = identificación
        $gestorU = new GestorUsuario();
        $gestorU->agregarUsuario($usuario);

        echo "<script>alert('Registro exitoso'); window.location='index.php?accion=login';</script>";
    }

    public function procesarRecuperacion($usuario)
    {
        echo "<script>alert('Se ha enviado un correo de recuperación (ficticio) a $usuario'); window.location='index.php?accion=login';</script>";
    }
}
