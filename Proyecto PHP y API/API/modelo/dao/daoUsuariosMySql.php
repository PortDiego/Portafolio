<?php 

    class DaoUsuariosMySql{
        public function crear($nombre, $contrasena){
            $consulta = "INSERT INTO usuarios (nombre, contrasena)
                        VALUES (?, ?)";

            MySqlBD::consultarEscritura($consulta, $nombre, $contrasena);
        }
    

        public function buscar($nombre){
            $resultado = MySqlBD::consultarLectura("SELECT nombre FROM usuarios WHERE nombre=?", $nombre);
            if(count($resultado) < 1){
                return null;
            }
            else{
                return $resultado[0]["nombre"];
            }
        }


    }
?>