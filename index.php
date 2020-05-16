<?php
session_start();
include_once 'commom/config.php';
include_once 'commom/function.php';
include_once 'commom/numberpages.php';

$module = isset($_GET["module"]) ? $_GET["module"] : "frontend";
$control = isset($_GET["control"]) ? $_GET["control"] : "home";
$action = isset($_GET["action"]) ? $_GET["action"] : "homes";

$filename = "controllers/" . $module . "/" . $control . "_controller.php";
if (file_exists($filename)) {
    $GLOBALS['module']=$module;
    $GLOBALS['control']=$control;
    require_once($filename);
} else {
    require_once("controllers/frontend/home_controller.php");
    $controller = new HomeController();
    if (!method_exists($controller, $action)) {
        $action = "homes";
    }
    //$data = $controller->$action();
     call_user_func_array([$controller, $action], []);

}
$control = ucfirst($control) . 'Controller';
$controller = new $control();
if (!method_exists($controller, $action)) {
    $action = "homes";
}
    //$data = $controller->$action();
      call_user_func_array([$controller, $action], []);


?>