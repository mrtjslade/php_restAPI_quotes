<?php
require_once('../../config/Database.php');
require_once('../../models/Category.php');

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Handle HTTP OPTIONS request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Instantiate new Category object
$category = new Category();

// Map HTTP methods to their respective PHP files
$routes = [
    'GET' => 'read.php',
    'POST' => 'create.php',
    'PUT' => 'update.php',
    'DELETE' => 'delete.php'
];

// Check if an ID was provided in the request
if (isset($_GET['id'])) {
    $filename = 'read_single.php';
} else {
    $filename = isset($routes[$method]) ? $routes[$method] : null;
}

// Check if the filename was set
if ($filename !== null) {
    // Include the appropriate PHP file
    require_once($filename);
} else {
    // Return an error message if the request method is not supported
    if ($method === 'PUT') {
        //http_response_code(400);
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        //http_response_code(405);
        echo json_encode(array('message' => 'Method not allowed.'));
    }
}
?>
