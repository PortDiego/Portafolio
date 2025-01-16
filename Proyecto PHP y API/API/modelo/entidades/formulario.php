<?php
class Formulario{
    public string $nombre;
    public string $texto;
    public string $depago;
    public DateTime $fecha;
    public int $id;

    function __construct(string $nombre, string $texto, string $depago, DateTime $fecha, int $id){
        $this->nombre = $nombre;
        $this->texto = $texto;
        $this->depago = $depago;
        $this->fecha = $fecha;
        $this->id = $id;
    }
        
}
?>