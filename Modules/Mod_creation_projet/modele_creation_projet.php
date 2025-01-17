<?php
require_once 'connexion.php';


class ModeleCreationProjet extends Connexion
{
    public function __construct() {
        parent::initConnexion();
    }
    public function creerProjet($nom, $description, $id_semestre, $id_annee)
    {
        try {
            $query = "INSERT INTO projet (nom, description, id_semestre, id_annee) VALUES (:nom, :description, :id_semestre, :id_annee)";
            $stmt = self::$bdd->prepare($query);
            return $stmt->execute([
                ':nom' => $nom,
                ':description' => $description,
                ':id_semestre' => $id_semestre,
                ':id_annee' => $id_annee,
            ]);
        } catch (Exception $e) {
            error_log("Erreur lors de la création du projet : " . $e->getMessage());
            return false;
        }
    }
}
?>