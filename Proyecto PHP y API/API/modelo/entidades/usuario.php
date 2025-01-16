<?php
class Usuario{
    public string $nombre;
    public string $contrasena;

    function __construct(string $nombre, string $contrasena){
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
    }

    public static function fromBody(){
        
        if (isset($_POST["nombre"]) && isset($_POST["contrasena"])){
           return new Usuario($_POST["nombre"], $_POST["contrasena"]); 
        }

        else{
            return new Usuario("", "");
        }
    }
        
}
?>