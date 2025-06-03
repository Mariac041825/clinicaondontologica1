<?php
session_start();
require_once 'Controlador/Controlador.php';
require_once 'Modelo/GestorCita.php';
require_once 'Modelo/Cita.php';
require_once 'Modelo/Paciente.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Medico.php';
require_once 'Modelo/GestorUsuario.php';

$controlador = new Controlador();
if (isset($_GET["accion"])) {
    if ($_GET["accion"] == "asignar") {
        $controlador->cargarAsignar();
    }elseif ($_GET["accion"] == "consultar") {
        $controlador->verPagina('Vista/html/consultar.php');
    } elseif ($_GET["accion"] == "inicio") {
        $controlador->verPagina('Vista/html/inicio.php');
    } elseif ($_GET["accion"] == "cancelar") {
        $controlador->verPagina('Vista/html/cancelar.php');
    } elseif ($_GET["accion"] == "guardarCita") {
        $controlador->agregarCita(
            $_POST["asignarDocumento"],
            $_POST["medico"],
            $_POST["fecha"],
            $_POST["hora"],
            $_POST["consultorio"]
        );
    } elseif ($_GET["accion"] == "consultarCitas") {
        $controlador->consultarCitas($_GET["consultarDocumento"]);
    } elseif ($_GET["accion"] == "cancelarCitas") {
        $controlador->cancelarCitas($_GET["cancelarDocumento"]);
    } elseif ($_GET["accion"] == "consultarPaciente") {
        $controlador->consultarPaciente($_GET["documento"]);
    } elseif ($_GET["accion"] == "ingresarPaciente") {
        $controlador->agregarPaciente(
            $_GET["PacDocumento"],
            $_GET["PacNombres"],
            $_GET["PacApellidos"],
            $_GET["PacNacimiento"],
            $_GET["PacSexo"]
        );
    } elseif ($_GET["accion"] == "consultarHora") {
        $controlador->consultarHorasDisponibles($_GET["medico"], $_GET["fecha"]);
    } elseif ($_GET["accion"] == "verCita") {
        $controlador->verCita($_GET["numero"]);
    } elseif ($_GET["accion"] == "confirmarCancelar") {
        $controlador->confirmarCancelarCita($_GET["numero"]);
    } elseif ($_GET["accion"] == "medicos") {
        $controlador->verMedicos();
    } elseif ($_GET["accion"] == "modificarMedico" && isset($_GET['id'])) {

        $controlador->modificarMedico($_GET['id']);
    } elseif ($_GET["accion"] == "guardarEdicion" && isset($_GET['id'])) {
        $controlador->guardarcambios($_GET['id'], $_POST['nombres'], $_POST['apellidos']);
    } elseif ($_GET["accion"] == "eliminarmedico" && isset($_GET['id'])) {

        $controlador->eliminarmedico($_GET['id']);
    } elseif ($_GET["accion"] == "agregarMedico") {
        $controlador->agregarmedico(
            $_POST["MedDocumento"],
            $_POST["MedNombres"],
            $_POST["MedApellidos"]
        );
    }
} else {
    $controlador->verPagina("Vista/html/login.php");
}
