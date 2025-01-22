<?php
require_once 'connexion.php';

class ModeleCreationProjet extends Connexion {
    public function __construct() {
        parent::initConnexion();
    }

    public function creerProjet($nom, $description, $id_semestre, $id_annee) {
        try {
            // Récupération depuis la session (déjà démarrée par le contrôleur)
            if (!isset($_SESSION['id_utilisateur'])) {
                throw new Exception("Accès non autorisé");
            }

            $id_utilisateur = $_SESSION['id_utilisateur'];

            // Récupération de l'ID enseignant
            $req = self::$bdd->prepare("SELECT id_enseignant FROM enseignant WHERE id_utilisateur = ?");
            $req->execute([$id_utilisateur]);
            $id_enseignant = $req->fetchColumn();

            if (!$id_enseignant) {
                throw new Exception("Droits insuffisants pour créer un projet");
            }

            // Transaction
            self::$bdd->beginTransaction();

            // Insertion projet
            $stmt = self::$bdd->prepare("INSERT INTO projet (nom, description, id_semestre, id_annee) 
                                       VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $description, $id_semestre, $id_annee]);
            $id_projet = self::$bdd->lastInsertId();

            // Lien responsable
            $stmt = self::$bdd->prepare("INSERT INTO responsable (id_enseignant, id_projet) VALUES (?, ?)");
            $stmt->execute([$id_enseignant, $id_projet]);

            self::$bdd->commit();
            return true;

        } catch (PDOException $e) {
            self::$bdd->rollBack();
            error_log("Erreur BDD : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur métier : " . $e->getMessage());
            return false;
        }
    }
}
?>