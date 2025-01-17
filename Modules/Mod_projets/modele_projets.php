<?php
require_once 'connexion.php';

class ModeleProjets extends Connexion {

    public function __construct() {
        parent::initConnexion();
    }

    public function getProjets() {
        try {
            $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
                      FROM projet p
                      LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                      LEFT JOIN annee a ON p.id_annee = a.id_annee";

            $stmt = self::$bdd->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur lors de la récupération des projets : " . $e->getMessage());
        }
    }
}
?>