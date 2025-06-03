<?php
class Usuario {
    private $identificacion;
    private $contrasena;
    private $tipo;

    public function __construct($ide, $con, $tip) {
        $this->identificacion = $ide;
        $this->contrasena = $con;
        $this->tipo = $tip;
    }

    public function obtenerIdentificacion() {
        return $this->identificacion;
    }
    public function obtenerContrasena() {
        return $this->contrasena;
    }
    public function obtenerTipo() {
        return $this->tipo;
    }
}
