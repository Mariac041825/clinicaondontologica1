<?php
class Controlador
{
    public function verPagina($ruta)
    {
        require_once $ruta;
    }

    public function agregarCita($doc, $med, $fec, $hor, $con)
    {
        $cita = new Cita(null, $fec, $hor, $doc, $med, $con, "Solicitada", "Ninguna");
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

    public function agregarPaciente($doc, $nom, $ape, $fec, $sex, $cont)
    {
        $paciente = new Paciente($doc, $nom, $ape, $fec, $sex, $cont);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente($paciente);

        echo $registros > 0
            ? "Se insertó el paciente con éxito"
            : "Error al grabar el paciente";
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

        echo $registros > 0
            ? "La cita se ha cancelado con éxito"
            : "Hubo un error al cancelar la cita";
    }

    public function verMedicos()
    {
        $conexion = new Conexion();
        $medicos = [];

        if ($conexion->abrir()) {
            $medicos = $conexion->obtenerMedicos();
            $conexion->cerrar();
        }

        require_once 'Vista/html/medicos.php';
    }

    public function modificarMedico($id)
    {
        $conexion = new Conexion();
        $medico = null;

        if ($conexion->abrir()) {
            $medico = $conexion->obtenerMedicoPorId($id);
            $conexion->cerrar();
        }

        require_once 'Vista/html/modificarMedico.php';
    }

    public function guardarCambios($id, $nombres, $apellidos)
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $conexion->cambiosMedico($id, $nombres, $apellidos);
            $conexion->cerrar();
        }

        header("Location: index.php?accion=medicos");
    }

    public function eliminarMedico($id)
    {
        $conexion = new Conexion();
        if ($conexion->abrir()) {
            $conexion->eliminarMedicos($id);
            $conexion->cerrar();
        }

        header("Location: index.php?accion=medicos");
    }

    public function agregarMedico($doc, $nom, $ape, $cont)
    {
        $medico = new Medico($doc, $nom, $ape, $cont);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarMedico($medico);

        echo $registros > 0
            ? "Se insertó el médico con éxito"
            : "Error al grabar el médico";
    }

    public function validarLogin($rol, $id, $pass)
    {
        require_once 'Modelo/Conexion.php';
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            echo "<script>alert('Error al conectar con la base de datos'); window.location='Vista/html/login.php';</script>";
            return;
        }

        if (empty($rol) || empty($id) || empty($pass)) {
            echo "<script>alert('Todos los campos son obligatorios'); window.location='Vista/html/login.php';</script>";
            return;
        }

        $tabla = "";
        $campoId = "";
        $campoPass = "";

        switch ($rol) {
            case "paciente":
                $tabla = "Pacientes";
                $campoId = "PacIdentificacion";
                $campoPass = "PacContrasena";
                break;
            case "medico":
                $tabla = "Medicos";
                $campoId = "MedIdentificacion";
                $campoPass = "MedContrasena";
                break;
            case "administrador":
                $tabla = "Administradores";
                $campoId = "AdmIdentificacion";
                $campoPass = "AdmContrasena";
                break;
            default:
                echo "<script>alert('Rol no válido'); window.location='Vista/html/login.php';</script>";
                return;
        }

        // Consulta segura (requiere método getConexion() que retorne mysqli)
        $mysqli = $conexion->getConexion();
        $stmt = $mysqli->prepare("SELECT * FROM $tabla WHERE $campoId = ? AND $campoPass = ?");
        $stmt->bind_param("ss", $id, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            session_start();
            $_SESSION["rol"] = $rol;
            $_SESSION["id"] = $id;
            header("Location: index.php");
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.location='Vista/html/login.php';</script>";
        }

        $stmt->close();
        $conexion->cerrar();
    }

    public function cerrarSesion()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}
