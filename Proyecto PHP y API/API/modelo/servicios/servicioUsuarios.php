<?php 

    class ServicioUsuarios{

        public static function crearUsuario($nombre, $contrasena){
            $daoUsuarios = new DaoUsuariosMySql();
            
            $hash = hash('sha256', $contrasena);
            
            $daoUsuarios->crear($nombre, $hash);
        }


        public static function buscarUsuario($nombre){
            $daoUsuarios = new DaoUsuariosMySql();
            return $daoUsuarios->buscar($nombre);
        }

    }
?>