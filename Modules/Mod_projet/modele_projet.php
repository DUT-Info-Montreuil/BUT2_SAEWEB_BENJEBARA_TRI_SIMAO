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

    public function getProjets($id_utilisateur = null) {
        try {
            if ($id_utilisateur) {
                $query = "SELECT 1 FROM etudiant WHERE id_utilisateur = :id_utilisateur";
                $stmt = self::$bdd->prepare($query);
                $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
                $stmt->execute();
                $isEtudiant = $stmt->rowCount() > 0;

                if ($isEtudiant) {
                    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee, p.id_semestre 
                              FROM projet p
                              LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                              LEFT JOIN annee a ON p.id_annee = a.id_annee
                              INNER JOIN etudiant e ON s.id_semestre = e.semestre_utilisateur
                              WHERE e.id_utilisateur = :id_utilisateur";
                } else {
                    $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee, p.id_semestre
                              FROM projet p
                              LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
                              LEFT JOIN annee a ON p.id_annee = a.id_annee";
                }
            } else {
                $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee, p.id_semestre 
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

    public function getProjet($id_projet) {
        $query = "SELECT p.id_projet, p.nom, p.description, s.type AS semestre, YEAR(a.debut_annee) AS annee, p.id_semestre 
        FROM projet p
        LEFT JOIN semestre s ON p.id_semestre = s.id_semestre
        LEFT JOIN annee a ON p.id_annee = a.id_annee
        WHERE p.id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRessources($id_projet) {
        $query = "SELECT r.* 
        FROM ressource r
        INNER JOIN responsable rep ON r.id_enseignant = rep.id_enseignant
        INNER JOIN projet p ON rep.id_projet = p.id_projet
        WHERE p.id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendus($id_projet) {
        $query = "SELECT * FROM rendu WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getSoutenances($id_projet) {
        $query = "SELECT * FROM soutenance WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGroupesProjet($id_projet) {
        $query = "SELECT g.id_groupe, g.nom FROM groupe g WHERE g.id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotesByEtudiant($id_etudiant) {
        $query = "SELECT n.note, e.type, e.coef 
                  FROM note n 
                  INNER JOIN evaluation e ON n.id_evaluation = e.id_evaluation
                  WHERE n.id_etudiant = :id_etudiant";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiantParUtilisateur($id_utilisateur) {
        $query = "SELECT e.id_etudiant, eg.id_groupe 
                  FROM etudiant e
                  LEFT JOIN etudiant_groupe eg ON e.id_etudiant = eg.id_etudiant
                  WHERE e.id_utilisateur = :id_utilisateur";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    public function getEtudiantsParSemestre($id_semestre) {
        $query = "SELECT e.id_etudiant, u.nom as nom_etudiant, u.prenom as prenom_etudiant, eg.id_groupe
                  FROM etudiant e
                  INNER JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
                  LEFT JOIN etudiant_groupe eg ON e.id_etudiant = eg.id_etudiant
                  WHERE e.semestre_utilisateur = :id_semestre";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_semestre', $id_semestre, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEtudiantsSansGroupe($id_semestre) {
        $query = "SELECT e.id_etudiant, u.nom, u.prenom 
                  FROM etudiant e
                  JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
                  LEFT JOIN etudiant_groupe eg ON e.id_etudiant = eg.id_etudiant
                  WHERE e.semestre_utilisateur = :id_semestre AND eg.id_groupe IS NULL";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_semestre', $id_semestre, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function envoyerDemandeGroupe($id_projet, $id_etudiant, $membres) {
        $query = "INSERT INTO demande_groupe (id_projet, id_etudiant, membres_demandes) 
                  VALUES (:id_projet, :id_etudiant, :membres)";
        $stmt = self::$bdd->prepare($query);
        $stmt->execute([
            ':id_projet' => $id_projet,
            ':id_etudiant' => $id_etudiant,
            ':membres' => implode(',', $membres)
        ]);
    }
    public function getEtudiantParNom($nom, $id_semestre) {
        $query = "SELECT e.id_etudiant 
                  FROM etudiant e
                  INNER JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
                  WHERE CONCAT(u.prenom, ' ', u.nom) = :nom 
                  AND e.semestre_utilisateur = :id_semestre";
        
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':id_semestre', $id_semestre, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}