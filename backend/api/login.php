<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['email']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'message' => 'Missing credentials']);
        exit;
    }

    try {
        $stmt = $pdo->prepare('SELECT id_utilisateur, nom, prenom, email FROM utilisateur WHERE email = ? AND mot_de_pass = ?');
        $stmt->execute([$data['email'], $data['password']]);
        $user = $stmt->fetch();

        if ($user) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $user['id_utilisateur'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email']
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Server error'
        ]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid method']);
?>