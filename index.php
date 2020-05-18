<?php

function router($classname)
{
    include_once $classname .".php";
}

spl_autoload_register('router');
session_start();
include_once 'Common/config.php';
include_once 'Common/function.php';
include_once 'Common/numberpages.php';

$module = isset($_GET["module"]) ? $_GET["module"] : "frontend";
$control = isset($_GET["control"]) ? $_GET["control"] : "home";
$action = isset($_GET["action"]) ? $_GET["action"] : "homes";

$filename = "controllers/" . $module . "/" . $control . ".php";
if (file_exists($filename)) {
    $GLOBALS['module'] = $module;
    $GLOBALS['control'] = $control;
    $classname = "Controllers\\" . ucfirst($module) . "\\" . ucfirst($control);
    $object = new $classname();
    if (!method_exists($object, $action)) {
        $action = "homes";
        $object->$action();
    } else {
        $object->$action();
    }
}else{
    $classname = "Controllers\\Frontend\\Home";
    $object = new $classname();
    if (!method_exists($object, $action)) {
        $action = "homes";
        $object->$action();
    } else {
        $object->$action();
    }
}


?>