<?php 

class Autorizacion{
    public static function verificarApiKey(){
        $UnauthorizedCode = 401;

        $headers = getallheaders();
        if(!isset($headers["ApiKey"]) || !ServicioAutenticacion::validarApiKey($headers["ApiKey"])){
            http_response_code($UnauthorizedCode);
            echo "Debes proporcionar un ApiKey";
            exit();
        }
        
    }
}

Autorizacion::verificarApiKey();
?>