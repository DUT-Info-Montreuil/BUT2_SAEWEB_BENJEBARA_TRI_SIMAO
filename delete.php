<?php
require_once 'connexion.php'; // Assurez-vous d'inclure votre fichier de connexion

class DeleteProjet extends Connexion {

    public function __construct() {
        parent::initConnexion();
    }

    public function deleteProjet($id_projet) {
        try {
            self::$bdd->beginTransaction(); // Commence une transaction

            // Supprimer les entrées dans la table responsable liées au projet
            $query = "DELETE FROM responsable WHERE id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les ressources liées au projet (via l'enseignant)
            $query = "DELETE r FROM ressource r
                      INNER JOIN responsable rep ON r.id_enseignant = rep.id_enseignant
                      WHERE rep.id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les rendus liés au projet
            $query = "DELETE FROM rendu WHERE id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les soutenances liées au projet
            $query = "DELETE FROM soutenance WHERE id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les associations de groupes liées au projet
            $query = "DELETE FROM etudiant_groupe WHERE id_groupe IN (SELECT id_groupe FROM groupe WHERE id_projet = :id_projet)";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les groupes liés au projet
            $query = "DELETE FROM groupe WHERE id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer le projet lui-même
            $query = "DELETE FROM projet WHERE id_projet = :id_projet";
            $stmt = self::$bdd->prepare($query);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->execute();

            self::$bdd->commit(); // Valide la transaction
            return true;

        } catch (Exception $e) {
            self::$bdd->rollBack(); // Annule la transaction en cas d'erreur
            die("Erreur lors de la suppression du projet : " . $e->getMessage());
        }
    }
}

// Utilisation de la classe
$id_projet = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_projet) {
    $delete = new DeleteProjet();
    if ($delete->deleteProjet($id_projet)) {
        // Redirection vers la liste des projets après la suppression
        header("Location: index.php?module=projets");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression du projet.";
    }
} else {
    echo "ID du projet manquant.";
}
?>