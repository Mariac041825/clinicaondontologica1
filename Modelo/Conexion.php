<?php
class Conexion
{
    private $mySQLI;
    private $sql;
    private $result;
    private $filasAfectadas;
    private $citaId;

    public function abrir()
    {
        $this->mySQLI = new mysqli("localhost", "root", "", "citas");

        if ($this->mySQLI->connect_error) {
            return 0;
        }
        return 1;
    }

    public function cerrar()
    {
        $this->mySQLI->close();
    }

    public function getConexion()
    {
        return $this->mySQLI;
    }

    public function consulta($sql)
    {
        $this->sql = $sql;
        $this->result = $this->mySQLI->query($this->sql);
        $this->filasAfectadas = $this->mySQLI->affected_rows;
        $this->citaId = $this->mySQLI->insert_id;
    }

    public function obtenerResult()
    {
        return $this->result;
    }

    public function obtenerFilasAfectadas()
    {
        return $this->filasAfectadas;
    }

    public function obtenerCitaId()
    {
        return $this->citaId;
    }

    public function obtenerMedicos()
    {
        $this->consulta("SELECT MedIdentificacion, MedNombres, MedApellidos FROM medicos");
        $medicos = [];

        while ($fila = $this->result->fetch_assoc()) {
            $medicos[] = $fila;
        }

        return $medicos;
    }

    public function obtenerMedicoPorId($id)
    {
        $stmt = $this->mySQLI->prepare("SELECT * FROM medicos WHERE MedIdentificacion = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }

    public function cambiosMedico($id, $nombres, $apellidos)
    {
        $stmt = $this->mySQLI->prepare("UPDATE medicos SET MedNombres = ?, MedApellidos = ? WHERE MedIdentificacion = ?");
        $stmt->bind_param("sss", $nombres, $apellidos, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function eliminarMedicos($id)
    {
        $stmt = $this->mySQLI->prepare("DELETE FROM medicos WHERE MedIdentificacion = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
