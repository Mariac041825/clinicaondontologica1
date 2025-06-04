<?php
session_start();

require_once 'Controlador/Controlador.php';
require_once 'Modelo/GestorCita.php';
require_once 'Modelo/Cita.php';
require_once 'Modelo/Paciente.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Medico.php';

$controlador = new Controlador();

if (isset($_GET["accion"])) {
    switch ($_GET["accion"]) {
        case "asignar":
            $controlador->cargarAsignar();
            break;

        case "consultar":
            $controlador->verPagina('Vista/html/consultar.php');
            break;

        case "inicio":
            $controlador->verPagina('Vista/html/inicio.php');
            break;

        case "cancelar":
            $controlador->verPagina('Vista/html/cancelar.php');
            break;

        case "guardarCita":
            $controlador->agregarCita(
                $_POST["asignarDocumento"],
                $_POST["medico"],
                $_POST["fecha"],
                $_POST["hora"],
                $_POST["consultorio"]
            );
            break;

        case "consultarCitas":
            $controlador->consultarCitas($_GET["consultarDocumento"]);
            break;

        case "cancelarCitas":
            $controlador->cancelarCitas($_GET["cancelarDocumento"]);
            break;

        case "consultarPaciente":
            $controlador->consultarPaciente($_GET["documento"]);
            break;

        case "ingresarPaciente":
            $controlador->agregarPaciente(
                $_GET["PacDocumento"],
                $_GET["PacNombres"],
                $_GET["PacApellidos"],
                $_GET["PacNacimiento"],
                $_GET["PacSexo"],
                $_GET["PacContrasena"]
            );
            break;

        case "consultarHora":
            $controlador->consultarHorasDisponibles($_GET["medico"], $_GET["fecha"]);
            break;

        case "verCita":
            $controlador->verCita($_GET["numero"]);
            break;

        case "confirmarCancelar":
            $controlador->confirmarCancelarCita($_GET["numero"]);
            break;

        case "medicos":
            $controlador->verMedicos();
            break;

        case "modificarMedico":
            if (isset($_GET['id'])) {
                $controlador->modificarMedico($_GET['id']);
            }
            break;

        case "guardarEdicion":
            if (isset($_GET['id'])) {
                $controlador->guardarcambios($_GET['id'], $_POST['nombres'], $_POST['apellidos']);
            }
            break;

        case "eliminarmedico":
            if (isset($_GET['id'])) {
                $controlador->eliminarmedico($_GET['id']);
            }
            break;

        case "agregarMedico":
            $controlador->agregarmedico(
                $_POST["MedDocumento"],
                $_POST["MedNombres"],
                $_POST["MedApellidos"],
                $_POST["MedContrasena"]
            );
            break;

        case "validarLogin":
            $controlador->validarLogin($_POST["rol"], $_POST["identificacion"], $_POST["contrasena"]);
            break;

        case "cerrarSesion":
            session_destroy();
            header("Location: index.php");
            break;

        default:
            if (!isset($_SESSION["rol"])) {
                require_once 'Vista/html/login.php';
            } else {
                $controlador->verPagina('Vista/html/inicio.php');
            }
            break;
    }
} else {
    if (!isset($_SESSION["rol"])) {
        require_once 'Vista/html/login.php';
    } else {
        $controlador->verPagina('Vista/html/inicio.php');
    }
}
