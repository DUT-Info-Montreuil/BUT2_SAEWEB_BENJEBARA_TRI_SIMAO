<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

include '../db.php';    

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['username']) || empty($data['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Username and password are required.']);
        exit;
    }

    $username = $data['username'];
    $password = $data['password'];

    if (strlen($username) < 3) {
        http_response_code(400);
        echo json_encode(['message' => 'Username must be at least 3 characters long.']);
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        http_response_code(409); 
        echo json_encode(['message' => 'Username already exists.']);
        exit;
    }

    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $hashedPassword]);

    http_response_code(201);
    echo json_encode(['message' => 'こんにちは']);

} elseif ($method === 'OPTIONS') {
    http_response_code(204);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>