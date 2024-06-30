<?php 

    class ServicioAutenticacion{

        public static function validarUsuarioContrasena($usuario, $contrasena){
            try{
                $resultado = MySqlBD::consultarLectura("SELECT contrasena FROM usuarios WHERE nombre= ?", $usuario);

                $hash = hash('sha256', $contrasena);
    
                return count($resultado) == 1 && $resultado[0]["contrasena"] == $hash;
            }
           catch(Exception $exc){
                GestorLogs::error($exc);
                throw new Exception("Ha ocurrido un problema al validar el usuario y la contraseña");
           }
            
        }

        public static function validarApiKey($apiKey){
            $resultado = MySqlBD::consultarLectura("SELECT apikey FROM apikeys WHERE apiKey = ?", $apiKey);
            return count($resultado) == 1;

        }
    }

?>