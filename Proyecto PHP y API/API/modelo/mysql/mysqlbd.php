<?php 

class MySqlBD{
    private static function conectar(){
        static $conexion = null;
        $config = parse_ini_file(__DIR__ . "/../../config.ini");

        if(!$conexion){
            $conexion = new mysqli($config["host"], $config["user"], $config["pass"], $config["bd"]);
        }
        
        return $conexion;
    }

    private static function preparar($conexion, $consulta, $parametros){
        $preparada = $conexion->prepare($consulta);
        if($parametros){
            $tipos ="";
            foreach($parametros as $parametro){
                $tipos .= is_integer($parametro) ? "i" : "s";
            }
            $preparada->bind_param($tipos, ...$parametros);
        }
        return $preparada;
    }

    public static function consultarLectura($consulta, ...$parametros){
        $conexion = self::conectar();

        $retorno = array();
        $preparada = self::preparar($conexion, $consulta, $parametros);
        $preparada->execute();
        $resultado = $preparada->get_result();

        while($fila = $resultado->fetch_assoc()){
            array_push($retorno, $fila);
        }

        return $retorno;
    }

    public static function consultarEscritura($consulta, ...$parametros){
        $conexion = self::conectar();

        $preparada = self::preparar($conexion, $consulta, $parametros);
        $preparada->execute();
    }
}


?>