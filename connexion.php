<?php

    class Connexion {
    protected static $bdd;

    public function __construct() {}

    public static function initConnexion() {
        $host = 'localhost';
        $dbname = 'sae'; // Remplacez par le nom de votre base de données
        $user = 'root'; // Utilisateur par défaut sur XAMPP
        $pass = 'chocolat'; // Mot de passe vide par défaut sur XAMPP

        try {
            self::$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}

    





?>
