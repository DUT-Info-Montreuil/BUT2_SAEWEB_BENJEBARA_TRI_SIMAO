<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
include '../db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query('SELECT * FROM tasks');
        $tasks = $stmt->fetchAll();
        echo json_encode($tasks);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['project_id'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Project ID is required']);
            exit;
        }

        $stmt = $pdo->prepare('INSERT INTO tasks (project_id, name, description, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['project_id'], $data['name'], $data['description'], $data['status']]);

        echo json_encode(['id' => $pdo->lastInsertId(), 'message' => 'Task created']);
        break;
    
    case 'OPTIONS':
        http_response_code(204);
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
?>