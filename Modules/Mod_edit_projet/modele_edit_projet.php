<?php
require_once 'connexion.php';

class ModeleEditProjet extends Connexion {

    public function __construct() { 
        parent::initConnexion(); 
        $this->db = self::$bdd; 
    
    
    
    }

    public function getProjet($id_projet) {
        $query = "SELECT * FROM projet WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProjet($id_projet, $nom, $description) {
        $query = "UPDATE projet SET nom = :nom, description = :description WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getRessources($id_projet) {
        $query = "SELECT * FROM ressource WHERE id_projet = :id_projet";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function addRessource($id_projet, $id_enseignant, $titre, $type, $lien, $fichier) { 
        $date_creation = date('Y-m-d'); 
        $query = "INSERT INTO ressource (id_projet, titre, type, lien, fichier, date_creation, id_enseignant) 
        VALUES (:id_projet, :titre, :type, :lien, :fichier, :date_creation, :id_enseignant)"; 
        $stmt = $this->db->prepare($query); 
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT); 
        $stmt->bindParam(':titre', $titre); 
        $stmt->bindParam(':type', $type); 
        $stmt->bindParam(':lien', $lien); 
        $stmt->bindParam(':fichier', $fichier); 
        $stmt->bindParam(':date_creation', $date_creation); 
        $stmt->bindParam(':id_enseignant', $id_enseignant); 
        return $stmt->execute();
}
    
    

    public function getRendus($id_projet) {
        $query = "SELECT * FROM rendu WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addRendu($id_projet, $nom, $description, $date_limite) {
        $query = "INSERT INTO rendu (nom, description, date_limite, id_projet) VALUES (:nom, :description, :date_limite, :id_projet)";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_limite', $date_limite);
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->execute();
    }
    
    public function getSoutenances($id_projet) {
        $query = "SELECT * FROM soutenance WHERE id_projet = :id_projet";
        $stmt = self::$bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSoutenance($id_projet, $id_groupe, $date_soutenance, $titre) {
      $query = "INSERT INTO soutenance (date_soutenance, titre, id_projet, id_groupe) VALUES (:date_soutenance, :titre, :id_projet, :id_groupe)";
      $stmt = self::$bdd->prepare($query);
      $stmt->bindParam(':date_soutenance', $date_soutenance);
      $stmt->bindParam(':titre', $titre);
      $stmt->bindParam(':id_projet', $id_projet);
      $stmt->bindParam(':id_groupe', $id_groupe);
      $stmt->execute();
  }
  

  public function getGroupesProjet($id_projet) {
    $query = "SELECT g.id_groupe, g.nom FROM groupe g WHERE g.id_projet = :id_projet";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getEnseignantId($id_utilisateur) {
  $query = "SELECT id_enseignant FROM enseignant WHERE id_utilisateur = :id_utilisateur";
  $stmt = self::$bdd->prepare($query);
  $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result ? $result['id_enseignant'] : null;
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

public function addStudentToGroup($id_etudiant, $id_groupe) {
    $query = "INSERT INTO etudiant_groupe (id_etudiant, id_groupe) VALUES (:id_etudiant, :id_groupe)";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
    $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
    $stmt->execute();
}

public function removeStudentFromGroup($id_etudiant, $id_groupe) {
    $query = "DELETE FROM etudiant_groupe WHERE id_etudiant = :id_etudiant AND id_groupe = :id_groupe";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
    $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
    $stmt->execute();
}

public function getStudentGrades($id_etudiant) {
    $query = "SELECT n.id_note, n.note, e.type, e.coef, n.id_etudiant
              FROM note n
              INNER JOIN evaluation e ON n.id_evaluation = e.id_evaluation
              WHERE n.id_etudiant = :id_etudiant";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return [];
    }
}

public function addGrade($id_etudiant, $id_groupe, $note, $type_evaluation, $coef) {
    if (!is_numeric($id_groupe) || $id_groupe <= 0) {
        throw new InvalidArgumentException("Invalid group ID provided.");
    }

    $query = "INSERT INTO evaluation (type, coef, est_individuel) VALUES (:type, :coef, TRUE)";
    $stmt = self::$bdd->prepare($query);
    $stmt->execute([
        ':type' => $type_evaluation,
        ':coef' => $coef
    ]);

    $id_evaluation = self::$bdd->lastInsertId();

    $query = "INSERT INTO note (id_evaluation, id_etudiant, id_groupe, note) 
              VALUES (:id_evaluation, :id_etudiant, :id_groupe, :note)";
    $stmt = self::$bdd->prepare($query);
    $stmt->execute([
        ':id_evaluation' => $id_evaluation,
        ':id_etudiant' => $id_etudiant,
        ':id_groupe' => $id_groupe,
        ':note' => $note
    ]);
}

public function updateGrade($id_note, $new_grade) {
    $query = "UPDATE note SET note = :new_grade WHERE id_note = :id_note";
    $stmt = self::$bdd->prepare($query);

    $stmt->bindParam(':new_grade', $new_grade, PDO::PARAM_STR);
    $stmt->bindParam(':id_note', $id_note, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        error_log("Error updating grade: " . $errorInfo[2]);
        return false;
    }
}

public function deleteGrade($id_note) {
    $query = "DELETE FROM note WHERE id_note = :id_note";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_note', $id_note, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

public function createGroup($id_projet, $nom_groupe) {
    $query = "INSERT INTO groupe (nom, id_projet) VALUES (:nom_groupe, :id_projet)";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':nom_groupe', $nom_groupe);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
}
public function getResponsablesProjet($id_projet) {
    $query = "SELECT r.id_responsable, u.nom, u.prenom 
              FROM responsable r
              JOIN enseignant e ON r.id_enseignant = e.id_enseignant
              JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
              WHERE r.id_projet = :id_projet";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function addResponsable($id_enseignant, $id_projet) {
    $query = "INSERT INTO responsable (id_enseignant, id_projet) VALUES (:id_enseignant, :id_projet)";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_enseignant', $id_enseignant, PDO::PARAM_INT);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
}

public function removeResponsable($id_responsable) {
    $query = "DELETE FROM responsable WHERE id_responsable = :id_responsable";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_responsable', $id_responsable, PDO::PARAM_INT);
    $stmt->execute();
}

public function getAllEnseignants($id_projet = null) {
    $query = "SELECT e.id_enseignant, u.nom, u.prenom 
              FROM enseignant e
              JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
              WHERE e.id_enseignant NOT IN (
                  SELECT id_enseignant 
                  FROM responsable 
                  WHERE id_projet = :id_projet
              )";

    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getDemandesGroupe($id_projet) {
    $query = "SELECT d.*, u.nom, u.prenom 
              FROM demande_groupe d
              JOIN etudiant e ON d.id_etudiant = e.id_etudiant
              JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
              WHERE d.id_projet = :id_projet";
    $stmt = self::$bdd->prepare($query);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getEtudiantIdParDemande($id_demande) {
    $query = "SELECT id_etudiant FROM demande_groupe WHERE id_demande = :id";
    $stmt = self::$bdd->prepare($query);
    $stmt->execute([':id' => $id_demande]);
    return $stmt->fetchColumn();
}

public function supprimerDemande($id_demande) {
    $query = "DELETE FROM demande_groupe WHERE id_demande = :id";
    $stmt = self::$bdd->prepare($query);
    $stmt->execute([':id' => $id_demande]);
}
}