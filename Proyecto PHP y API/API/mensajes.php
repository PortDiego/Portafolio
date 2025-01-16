<?php 

include_once "modelo/entidades/formulario.php";
include_once "modelo/servicios/servicioMensajes.php";
include_once "modelo/servicios/servicioAutenticacion.php";
include_once "modelo/mysql/mysqlbd.php";
include_once "modelo/dao/daoMensajesMySql.php";
include_once "modelo/dao/daoUsuariosMySql.php";
include_once "modelo/servicios/servicioUsuarios.php";
include_once "modelo/entidades/usuario.php";
include_once "dto/formularioDto.php";
include_once "comun/autorizacion.php";

$NotFoundCode = 404;
$MethodNotAllowedCode = 405;
$BadRequestCode = 400;

$metodo = $_SERVER["REQUEST_METHOD"]; //POST, GET, PUT, DELETE, etc.

switch($metodo){
    case "POST":
        $cuerpo = file_get_contents("php://input");

        if($cuerpo){
            $mensajeDto = FormularioDto::fromJson($cuerpo);

            $mensaje = $mensajeDto->toFormulario();
            ServicioMensajes::insertarMensaje($mensaje);
        }
        else{
            echo "La solicitud no puede estar vacía";
            http_response_code($BadRequestCode);
        }
        break;

    case "GET":
        if(isset($_GET["id"]) && $_GET["id"] !=""){ //mensajes.php?id=1
            $id = $_GET["id"];
            $mensaje = ServicioMensajes::buscarMensaje($id);

            if($mensaje){
                header("Content-Type: application/json");
                echo json_encode(FormularioDto::fromFormulario($mensaje));
            }
            else{
                echo "Mensaje con id $id no encontrado";
                http_response_code($NotFoundCode );
            }
        }
        else{ //mensajes.php
            $mensajes = servicioMensajes::obtenerMensaje();
            $listaMensajesDto = array();

            foreach($mensajes as $mensaje){
                array_push($listaMensajesDto, FormularioDto::fromFormulario($mensaje));
            }
            echo json_encode($listaMensajesDto);
        }
        break;

    case "PUT":
        $cuerpo = file_get_contents("php://input");

        if($cuerpo){
            $mensajeDto = FormularioDto::fromJson($cuerpo);

            $mensaje = $mensajeDto->toFormulario();
            ServicioMensajes::actualizarMensaje($mensaje);
        }
        else{
            echo "La solicitud no puede estar vacía";
            http_response_code($BadRequestCode);
        }
        break;

    case "DELETE":
        if(isset($_GET["id"]) && $_GET["id"] !=""){
            $id = $_GET["id"];
            servicioMensajes::borrarMensaje($id);
        }
        else{
            echo "El id es obligatorio";
            http_response_code($BadRequestCode);
        }
        break;

    default:
        http_response_code($MethodNotAllowedCode);
        break;
}

?>