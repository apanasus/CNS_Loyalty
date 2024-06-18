<?php

require_once '../config/config.php';
require_once '../src/controllers/UserController.php';
require_once '../src/controllers/GroupController.php';
require_once '../src/controllers/PermissionController.php';

$config = require '../config/config.php';

$controller = null;
$action = null;

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controllerName = ucfirst($_GET['controller']) . 'Controller';
    $action = $_GET['action'];
    $controllerPath = '../src/controllers/' . $controllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controller = new $controllerName($config);
    }
}

if ($controller && method_exists($controller, $action)) {
    $controller->$action();
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(['error' => 'Not Found']);
}
