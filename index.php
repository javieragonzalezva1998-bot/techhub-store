<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config/database.php";

$controller = $_GET['controller'] ?? 'producto';
$action = $_GET['action'] ?? 'index';

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "app/controllers/" . $controllerName . ".php";

if (!file_exists($controllerFile)) {
    die("Error: el controlador no existe: " . $controllerFile);
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    die("Error: la clase no existe: " . $controllerName);
}

$controllerInstance = new $controllerName();

if (!method_exists($controllerInstance, $action)) {
    die("Error: la acción no existe: " . $action);
}

$controllerInstance->$action();