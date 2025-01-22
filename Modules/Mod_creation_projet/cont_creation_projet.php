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

        // Log des données reçues
        error_log("Données reçues : nom=$nom, description=$description, id_semestre=$id_semestre, id_annee=$id_annee");

        // Validation des données (à améliorer)
        if (empty($nom) || empty($description) || empty($id_semestre) || empty($id_annee)) {
            error_log("Erreur de validation : champs manquants");
            $this->vue->afficherErreur("Tous les champs sont obligatoires.");
            return;
        }

        // Log avant d'appeler le modèle
        error_log("Tentative de création du projet avec les données validées.");

        if ($this->modele->creerProjet($nom, $description, $id_semestre, $id_annee)) {
            // Log succès
            error_log("Projet créé avec succès.");
            // Redirection après création réussie
            header("Location: index.php?module=projets"); // Ou une autre page de confirmation
            exit;
        } else {
            // Log erreur lors de l'appel du modèle
            error_log("Erreur : échec de la création du projet dans le modèle.");
            $this->vue->afficherErreur("Erreur lors de la création du projet.");
        }
    }
}

?>
