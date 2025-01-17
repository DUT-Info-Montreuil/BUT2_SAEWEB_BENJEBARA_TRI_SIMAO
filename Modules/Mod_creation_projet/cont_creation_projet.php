<?php

require_once 'modele_creation_projet.php';
require_once 'vue_creation_projet.php';


class ContCreationProjet {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleCreationProjet();
        $this->vue = new VueCreationProjet();
    }

    public function afficherFormulaire() {
        $this->vue->afficherFormulaireCreation();
    }

    public function creerProjet() {
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $id_semestre = isset($_POST['id_semestre']) ? $_POST['id_semestre'] : '';
        $id_annee = isset($_POST['id_annee']) ? $_POST['id_annee'] : '';

        // Validation des données (à améliorer)
        if (empty($nom) || empty($description) || empty($id_semestre) || empty($id_annee)) {
            $this->vue->afficherErreur("Tous les champs sont obligatoires.");
            return;
        }

        if ($this->modele->creerProjet($nom, $description, $id_semestre, $id_annee)) {
            // Redirection après création réussie
            header("Location: index.php?module=projets"); // Ou une autre page de confirmation
            exit;
        } else {
            $this->vue->afficherErreur("Erreur lors de la création du projet.");
        }
    }
}

?>