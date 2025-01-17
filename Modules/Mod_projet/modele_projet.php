<?php
require_once 'connexion.php';

class ModeleProjet extends Connexion {

    public function __construct() {
        parent::initConnexion();
    }
    public function isEnseignant($id_utilisateur) {
        try {
            $query = "SELECT e.id_enseignant 
                     FROM enseignant e 
                     WHERE e.id_utilisateur = :id_utilisateur";
            
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            die("Erreur lors de la vérification enseignant : " . $e->getMessage());
        }
    }
    public function getProjet($idProjet) {
        try {
            $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, CONCAT(YEAR(a.debut_annee), '-', YEAR(a.debut_annee) + 1) AS annee
                      FROM projet p
                      LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                      LEFT JOIN annee a ON p.id_annee = a.id_annee
                      WHERE p.id_projet = :id_projet";

            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $idProjet, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur lors de la récupération du projet : " . $e->getMessage());
        }
    }
}
?>