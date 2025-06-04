<?php
class Medico {
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $contrasena;
   

    public function __construct($ide, $nom, $ape, $cont ) {
        $this->identificacion = $ide;
        $this->nombres = $nom;
        $this->apellidos = $ape;
        $this->contrasena = $cont;
    }
    

    public function obtenerIdentificacion() {
        return $this->identificacion;
    }

    public function obtenerNombres() {
        return $this->nombres;
    }

    public function obtenerApellidos() {
        return $this->apellidos;
    }

     public function obtenerContrasena() {
        return $this->contrasena;
    }

}
?>