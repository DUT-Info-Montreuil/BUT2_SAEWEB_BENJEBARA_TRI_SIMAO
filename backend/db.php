<?php
	try{
		$dsn = 'mysql:host=localhost;dbname=sae';
		$user = 'root';
		$password = 'chocolat';
		$pdo = new PDO ($dsn, $user, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		error_log('Connection error: ' . $e->getMessage());
		die(json_encode(['success' => false, 'message' => 'Database connection error']));
	}
?>