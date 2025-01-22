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
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() for a single student
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
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ? $result : []; // Retourne un tableau vide si aucun résultat
    }

    public function getEtudiantIdParNomPrenom($nom, $prenom) {
        $query = "SELECT id_etudiant FROM etudiant e
                  INNER JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
                  WHERE u.nom = :nom AND u.prenom = :prenom";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id_etudiant'] : null;
    }

    public function creerDemandeGroupe($id_projet, $id_etudiant, $membres_groupe_texte) {
    try {
        self::$bdd->beginTransaction();

        // Générer un nom pour le nouveau groupe (exemple : "Groupe de " + nom du premier étudiant)
        // Ici, on extrait le premier nom de la chaîne pour la suggestion du nom de groupe
        $noms = explode(',', $membres_groupe_texte);
        $premierNom = trim($noms[0]);
        $nom_groupe = "Groupe de " . $premierNom;

        // Insérer le nouveau groupe
        $query = "INSERT INTO groupe (nom, id_projet) VALUES (:nom_groupe, :id_projet)";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':nom_groupe', $nom_groupe, PDO::PARAM_STR);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        $id_groupe = self::$bdd->lastInsertId();

        // Insérer la demande de groupe avec la chaîne des membres
        $query = "INSERT INTO demande_groupe (id_projet, id_etudiant, id_groupe, membres, date_demande) VALUES (:id_projet, :id_etudiant, :id_groupe, :membres, NOW())";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $stmt->bindParam(':membres', $membres_groupe_texte, PDO::PARAM_STR); // Enregistrement de la chaîne
        $stmt->execute();

        self::$bdd->commit();
        return true;
    } catch (Exception $e) {
        self::$bdd->rollBack();
        die("Erreur lors de la création de la demande de groupe : " . $e->getMessage());
        return false;
    }
}
}