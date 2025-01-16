<?php 

include_once "modelo/servicios/servicioAutenticacion.php";
include_once "modelo/servicios/servicioUsuarios.php";
include_once "modelo/mysql/mysqlbd.php";
include_once "dto/loginDto.php";
include_once "comun/autorizacion.php";
include_once "modelo/dao/daoUsuariosMySql.php";

$MethodNotAllowedCode = 405;
$BadRequestCode = 400;

$metodo = $_SERVER["REQUEST_METHOD"];

switch($metodo){
    
    case "POST":
        $cuerpo = file_get_contents("php://input");
        if($cuerpo){
            $loginDto = LoginDto::fromJson($cuerpo);
            if(servicioUsuarios::buscarUsuario($loginDto->usuario)){
                if(servicioAutenticacion::validarUsuarioContrasena($loginDto->usuario, $loginDto->contrasena)){
                    echo "Usuario y contraseña correctos";
                }
                else{
                    echo "Usuario y/o contraseña incorrectos";
                    http_response_code($BadRequestCode);
                }
            }
            else{
                if(servicioUsuarios::crearUsuario($loginDto->usuario, $loginDto->contrasena)){
                    echo "Usuario creado correctamente";
                }
                else{
                    echo "Error al crear usuario";
                }
            } 
        }
        else{
            echo "La solicitud no puede estar vacía";
            http_response_code($BadRequestCode);
        }
        break;
    default:
        http_response_code($MethodNotAllowedCode);
        break;
}

?>