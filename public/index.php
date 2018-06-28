<?php
//require __DIR__ . '\..\vendor\autoload.php';
//require '..\app\Core\example-config.php';
//
//define('APPLICATION_PATH', getcwd().'/../app/');
//define('PUBLIC_PATH', getcwd());
////$users = new App\Models\User();
////$data = ['login' => 'asd', 'password'=> '2', 'name' => '2', 'age'=> 2, 'description' => null, 'photo_name' => null];
//////$users->createUser($data);
////$users->deleteUser(45);
//
//$url = explode('?', $_SERVER['REQUEST_URI']);
//$routes = explode('/', $url[0]);
//var_dump($url);
//$controller_name = 'index';
////session_start();
//if (!empty($routes[1])) {
//    $controller_name = $routes[1] . "Controller";
//    $action_name = $routes[1] . "Action";
//}
//$filename = "controllers/" . $controller_name . ".php";
//try {
//    if (file_exists($filename)) {
//        require_once $filename;
//    } else {
//        throw new Exception("File not found");
//    }
//    $classname = $controller_name;
//    if (class_exists($classname)) {
//        $controller = new $classname();
//    } else {
//        throw new Exception("File found but class not found");
//    }
//    if (method_exists($controller, $action_name)) {
//        $controller->$action_name();
//    } else {
//        throw new Exception("Method not found");
//    }
//} catch (Exception $e) {
//    require "errors/404.php";
//}

define('APP_PATH', getcwd().'/../app/');
define('PUBLIC_PATH', getcwd());
require APP_PATH.'../vendor/autoload.php';
require APP_PATH . 'Core/config.php';
session_start();
// /users/test
$routes = explode('?', $_SERVER['REQUEST_URI']);
$routes = explode('/', $routes[0]);
$controller_name = 'indexController';
$action_name = 'indexAction';
// получаем контроллер
if (!empty($routes[1])) {
    $controller_name = ucfirst($routes[1]).'Controller'; //posts
    $action_name = $routes[1].'Action'; //create
}

$filename = APP_PATH."Controllers/".$controller_name.".php";
try {
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new Exception("File not found");
    }
    $classname = '\App\Controllers\\'.$controller_name;// \App\Posts
    if (class_exists($classname)) {
        $controller = new $classname();
    } else {
        throw new Exception("File found but class not found");
    }
    if (method_exists($controller, $action_name)) {
        $controller->$action_name();
    } else {
        throw new Exception("Method not found");
    }
} catch (Exception $e) {
    require PUBLIC_PATH."/errors/404.php";
}