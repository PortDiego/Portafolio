<?php 
    class DaoMensajesMySql{
        public function crear($formulario){
            $depago = $formulario->depago == "Usuario de pago" ? 1 : 0;
            $fecha = $formulario->fecha->format("c");
            $consulta = "INSERT INTO mensajes (nombre, texto, depago, fecha)
                        VALUES (?, ?, ?, ?)";

            MySqlBD::consultarEscritura($consulta, $formulario->nombre, $formulario->texto, $depago, $fecha);
        }

        public function buscar($id){
            $resultado = MySqlBD::consultarLectura("SELECT * FROM mensajes WHERE id=?", $id);
            if(count($resultado) < 1){
                return null;
            }
            else{
                return $this->mensajeFromValueArray($resultado[0]);
            }
        }

        public function actualizar($formulario){
            $depago = $formulario->depago == "Usuario de pago" ? 1 : 0;
            $fecha = $formulario->fecha->format("c");
            $consulta = "UPDATE mensajes SET nombre= ?, texto= ?, depago= ?, fecha= ? WHERE id= ?";

            MySqlBD::consultarEscritura($consulta, $formulario->nombre, $formulario->texto, $depago, $fecha, $formulario->id);
        }

        public function eliminar($id){
            $consulta = "DELETE FROM mensajes WHERE id= ?";

            MySqlBD::consultarEscritura($consulta, $id);
        }

        public function listar(){
            $resultado = MySqlBD::consultarLectura("SELECT * FROM mensajes");

            $retorno = array();
            foreach($resultado as $fila){
                $formulario = $this->mensajeFromValueArray($fila);
                array_push($retorno, $formulario);
            }
            return $retorno;
        }

        private function mensajeFromValueArray($fila){
            $depago = $fila["depago"] ? "Usuario de pago" : "Usuario normal";
            $fecha = new Datetime($fila["fecha"]);
            return new Formulario($fila["nombre"], $fila["texto"], $depago, $fecha, $fila["id"]);
        }
    }

?>