<?php
class FormularioDto{
    public string $nombre;
    public string $texto;
    public string $depago;
    public string $fecha;
    public string $id;

    function __construct(string $nombre, string $texto, string $depago, string $fecha, string $id){
        $this->nombre = $nombre;
        $this->texto = $texto;
        $this->depago = $depago;
        $this->fecha = $fecha;
        $this->id = $id;
    }
        
    public function toFormulario(){
        $fecha = $this->fecha ? new DateTime($this->fecha) : new DateTime();
        
        return new Formulario($this->nombre, $this->texto, $this->depago, $fecha, (int)$this->id);
    }

    public static function fromFormulario($formulario){
        return new FormularioDto($formulario->nombre, $formulario->texto, $formulario->depago, $formulario->fecha->format("c"), $formulario->id);
    }

    public static function fromJson($json){
        $objeto = json_decode($json);

        $nombre = isset($objeto->nombre) ? $objeto->nombre : "";
        $texto = isset($objeto->texto) ? $objeto->texto : "";
        $depago = isset($objeto->depago) ? $objeto->depago : "";
        $fecha = isset($objeto->fecha) ? $objeto->fecha : "";
        $id = isset($objeto->id) ? $objeto->id : "0";

        return new FormularioDto($nombre, $texto, $depago, $fecha, $id);
    }
}
?>