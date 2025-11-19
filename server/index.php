<?php 
require_once("./services/ResponseService.php");
require_once("./routes/apis.php");

// Get the JSON from Client side
$postData = json_decode(file_get_contents("php://input"), true);


$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}


$request = trim($request, '/');
$request = explode('/', $request);

// Find controller
$controller = null;
if (isset($request[0])) {
    $controller = $request[0];
}

// Find method
$method = null;
if (isset($request[1])) {
    $method = $request[1];
}


if (isset($apis[$controller]) && isset($apis[$controller]['methods'][$method])) {
    $controller_name = $apis[$controller]['controller']; 
    $method_name = $apis[$controller]['methods'][$method];

    require_once "controllers/{$controller_name}.php";
    $controller = new $controller_name();

    if (method_exists($controller, $method_name)) {
        $controller->$method_name($postData);
    } else {
        echo ResponseService::response(500, "Error: Method {$method} not found in {$controller_name}");
    }
} else {
    echo ResponseService::response(404, "Route Not Found");
}

?>