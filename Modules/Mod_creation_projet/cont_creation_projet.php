<?php
require_once 'modele_creation_projet.php';
require_once 'vue_creation_projet.php';

class ContCreationProjet {
    private $modele;
    private $vue;

    public function __construct() {
        session_start();
        $this->modele = new ModeleCreationProjet();
        $this->vue = new VueCreationProjet();
    }

    public function afficherFormulaire() {
        if (!isset($_SESSION['id_utilisateur'])) {
            header("Location: index.php?module=connexion");
            exit;
        }
        $this->vue->afficherFormulaireCreation();
    }

    public function creerProjet() {
        if (!isset($_SESSION['id_utilisateur'])) {
            header("Location: index.php?module=connexion");
            exit;
        }

        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $id_semestre = $_POST['id_semestre'] ?? '';
        $id_annee = $_POST['id_annee'] ?? '';

        if (empty($nom) || empty($description) || empty($id_semestre) || empty($id_annee)) {
            $this->vue->afficherErreur("Tous les champs sont obligatoires.");
            return;
        }

        if ($this->modele->creerProjet($nom, $description, $id_semestre, $id_annee)) {
            header("Location: index.php?module=projets");
            exit;
        } else {
            $this->vue->afficherErreur("Erreur lors de la création du projet.");
        }
    }
}
?>