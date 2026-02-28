<?php
session_start();

require_once '../app/config/database.php';

$controller = $_GET['c'] ?? 'home';
$action     = $_GET['a'] ?? 'index';

$controllerName = ucfirst($controller) . 'Controller';

require_once "../app/controllers/$controllerName.php";

$obj = new $controllerName($db);
$obj->$action();
