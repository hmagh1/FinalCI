<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\UserController;

header('Content-Type: application/json');
//test
// Initialiser le contrôleur
$controller = new UserController();

// Détecter la méthode HTTP et le chemin
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Lire les données JSON ou form-encoded
$input = json_decode(file_get_contents("php://input"), true);
parse_str(file_get_contents("php://input"), $putData); // fallback for PUT
$name = $input['name'] ?? $_POST['name'] ?? $putData['name'] ?? null;
$email = $input['email'] ?? $_POST['email'] ?? $putData['email'] ?? null;

// Routing
if ($path === '/users' && $method === 'GET') {
    echo $controller->getAllUsers();

} elseif (preg_match('#^/users/(\d+)$#', $path, $matches)) {
    $id = (int)$matches[1];

    if ($method === 'GET') {
        echo $controller->getUser($id);
    } elseif ($method === 'PUT') {
        echo $controller->updateUser($id, $name, $email);
    } elseif ($method === 'DELETE') {
        echo $controller->deleteUser($id);
    }

} elseif ($path === '/users' && $method === 'POST') {
    echo $controller->createUser($name, $email);

} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found"]);
}
