<?php
require_once 'connexion.php';

class ModeleProjets extends Connexion {

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

    public function getProjets($id_utilisateur = null) {
        try {
            if ($id_utilisateur) {
                $query = "SELECT 1 FROM etudiant WHERE id_utilisateur = :id_utilisateur";
                $stmt = self::$bdd->prepare($query);
                $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
                $stmt->execute();
                $isEtudiant = $stmt->rowCount() > 0;

                if ($isEtudiant) {
                    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
                              FROM projet p
                              LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                              LEFT JOIN annee a ON p.id_annee = a.id_annee
                              INNER JOIN etudiant e ON s.id_semestre = e.semestre_utilisateur
                              WHERE e.id_utilisateur = :id_utilisateur";
                } else {
                    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
                              FROM projet p
                              LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                              LEFT JOIN annee a ON p.id_annee = a.id_annee";
                }
            } else {
                $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
                          FROM projet p
                          LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                          LEFT JOIN annee a ON p.id_annee = a.id_annee";
            }

            $stmt = self::$bdd->prepare($query);
            if ($id_utilisateur && $isEtudiant) {
                $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur lors de la récupération des projets : " . $e->getMessage());
        }
    }
}
?>