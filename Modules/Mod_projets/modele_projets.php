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

    public function getProjets() {
        try {
            $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee 
                      FROM projet p
                      LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                      LEFT JOIN annee a ON p.id_annee = a.id_annee";
    
            $stmt = self::$bdd->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur lors de la récupération des projets : " . $e->getMessage());
        }
    }

    public function getEnseignantId($id_utilisateur) {
        $query = "SELECT id_enseignant FROM enseignant WHERE id_utilisateur = :id_utilisateur";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id_enseignant'] : null;
    }
    
    public function getProjetsResponsable($id_enseignant) {
        $query = "SELECT id_projet FROM responsable WHERE id_enseignant = :id_enseignant";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_enseignant', $id_enseignant, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); 
        return $result ?: [];
    }
    
}