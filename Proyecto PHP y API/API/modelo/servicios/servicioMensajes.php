<?php 

    class ServicioMensajes{

        public static function obtenerMensaje(){
            $daoMensajes = new DaoMensajesMySql();
            return $daoMensajes->listar();
        }

        public static function insertarMensaje($formulario){
            $daoMensajes = new DaoMensajesMySql();
            $daoMensajes->crear($formulario);
        }
        
        public static function buscarMensaje($id){
            $daoMensajes = new DaoMensajesMySql();
            return $daoMensajes->buscar($id);
        }
        
        public static function actualizarMensaje($formulario){
            $daoMensajes = new DaoMensajesMySql();
            $daoMensajes->actualizar($formulario);
        }

        public static function borrarMensaje($id){
            $daoMensajes = new DaoMensajesMySql();
            $daoMensajes->eliminar($id);
        }
    }

?>