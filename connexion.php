<?php

    class Connexion {
    protected static $bdd;

    public function __construct() {}

    public static function initConnexion() {
        $host = 'localhost';
        $dbname = 'sae';
        $user = 'root';
        $pass = '';

        try {
            self::$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}

    





?>
