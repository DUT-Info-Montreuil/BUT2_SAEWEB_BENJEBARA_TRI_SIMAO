<?php
require_once 'connexion.php';

class ModeleEditProjet extends Connexion {

    public function __construct() {
        parent::initConnexion();
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
    
    public function addRessource($id_enseignant, $titre, $type, $lien) {
      $date_creation = date('Y-m-d');
      $query = "INSERT INTO ressource (titre, type, lien, date_creation, id_enseignant) VALUES (:titre, :type, :lien, :date_creation, :id_enseignant)";
      $stmt = self::$bdd->prepare($query);
      $stmt->bindParam(':titre', $titre);
      $stmt->bindParam(':type', $type);
      $stmt->bindParam(':lien', $lien);
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

}