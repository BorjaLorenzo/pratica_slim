<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Jenssegers\Blade\Blade;

session_start();
require 'vendor/autoload.php';
require __DIR__.'/ctes.php';
define('BASE_URL', 'http://localhost/projectos/php/pratica_slim/index.php/');
require 'controllers/Controlador.php';


$config = [
    'settings' => [
        'displayErrorDetails' => true,

        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];

$app = new \Slim\App($config);


$app->any('/', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->verLogin());
});
$app->any('/login', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->verLogin());
});
$app->any('/checkLogin', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->CheckLogin());
});
$app->any('/checkTareas', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->CheckTarea());
});
$app->any('/insertarTarea', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->ShowInsertarTarea());
});
$app->any('/tablaTareas', function (Request $req,  Response $res, $args = []) {
    Usuario::SalirSiNoDentro();
    return $res->getBody()->write(Controlador::getInstance()->ShowTabla());
});
$app->any('/menuADM', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->ShowMenuAdm());
});
$app->any('/menuOP', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_operario');
    return $res->getBody()->write(Controlador::getInstance()->ShowMenuOP($test));
});
$app->any('/borrarTarea', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_tarea');
    return $res->getBody()->write(Controlador::getInstance()->borrarTarea($test));
});
$app->any('/modificarTarea', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_tarea');
    return $res->getBody()->write(Controlador::getInstance()->modificarTarea($test));
});
$app->any('/tareamodificada', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->tareamodificada());
});
$app->any('/tablaUsuarios', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->ShowUsuarios());
});
$app->any('/insertarUsuario', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->ShowInsertarUsuario());
});
$app->any('/checkUsuario', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->insertarUsuario());
});
$app->any('/modificarUsuario', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_trabajador');
    return $res->getBody()->write(Controlador::getInstance()->modificarUsuario($test));
});
$app->any('/usuarioModificado', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->usuarioModificado());
});
$app->any('/borrarUsuario', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_trabajador');
    return $res->getBody()->write(Controlador::getInstance()->eliminarUsuario($test));
});
$app->any('/tablaTareasOperario', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_operario');
    return $res->getBody()->write(Controlador::getInstance()->showTablaOperarios($test));
});
$app->any('/realizarTarea', function (Request $req,  Response $res, $args = []) {
    $id=$req->getParam('id_tarea');
    $op=$req->getParam('id_operario');
    return $res->getBody()->write(Controlador::getInstance()->realizarTarea($id,$op));
});
$app->any('/cancelarTarea', function (Request $req,  Response $res, $args = []) {
    $id=$req->getParam('id_tarea');
    $op=$req->getParam('id_operario');
    return $res->getBody()->write(Controlador::getInstance()->cancelarTarea($id,$op));
});
$app->any('/configuracionOP', function (Request $req,  Response $res, $args = []) {
    $test=$req->getParam('id_operario');
    return $res->getBody()->write(Controlador::getInstance()->showConfiguracion($test));
});
$app->any('/cambiarPass', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->cambiarPass());
});
$app->any('/cerrarSesion', function (Request $req,  Response $res, $args = []) {
    return $res->getBody()->write(Controlador::getInstance()->cerrarSesion());
});
$app->run();