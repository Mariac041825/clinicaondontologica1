<?php
class Medico {
    private $identificacion;
    private $nombres;
    private $apellidos;
   

    public function __construct($ide, $nom, $ape ) {
        $this->identificacion = $ide;
        $this->nombres = $nom;
        $this->apellidos = $ape;
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

 
}
?>