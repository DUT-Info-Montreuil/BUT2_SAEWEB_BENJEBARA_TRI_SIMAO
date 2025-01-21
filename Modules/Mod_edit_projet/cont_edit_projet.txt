<?php
require_once 'modele_edit_projet.php';
require_once 'vue_edit_projet.php';

class ContEditProjet {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleEditProjet();
        $this->vue = new VueEditProjet();
    }

    public function editProjet($id_projet) {
        session_start();
        $projet = $this->modele->getProjet($id_projet);
        $ressources = $this->modele->getRessources($id_projet);
        $rendus = $this->modele->getRendus($id_projet);
        $soutenances = $this->modele->getSoutenances($id_projet);
        $groupes = $this->modele->getGroupesProjet($id_projet); 

        if (!$projet) {
            // Gérer l'erreur, par exemple rediriger vers une page d'erreur 404
            $this->vue->afficherErreur("Projet non trouvé");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'update_projet') {
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $this->modele->updateProjet($id_projet, $nom, $description);
                $projet['nom'] = $nom; // Mettre à jour pour l'affichage
                $projet['description'] = $description; // Mettre à jour pour l'affichage
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_ressource') {
                $titre = $_POST['titre'];
                $type = $_POST['type'];
                $lien = $_POST['lien'];
                $id_utilisateur = $_SESSION['id_utilisateur'];
                $id_enseignant = $this->modele->getEnseignantId($id_utilisateur);
            
                if ($id_enseignant && $this->modele->addRessource($id_enseignant, $titre, $type, $lien)) {
                    $ressources = $this->modele->getRessources($id_projet); 
                } else {
                }
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_rendu') {
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $date_limite = $_POST['date_limite'];
                $this->modele->addRendu($id_projet, $nom, $description, $date_limite);
                $rendus = $this->modele->getRendus($id_projet);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_soutenance') {
                $id_groupe = $_POST['id_groupe'];
                $date_soutenance = $_POST['date_soutenance'];
                $titre = $_POST['titre'];
                $this->modele->addSoutenance($id_projet, $id_groupe, $date_soutenance, $titre);
                $soutenances = $this->modele->getSoutenances($id_projet);
            }
            
            $projet = $this->modele->getProjet($id_projet);
            $ressources = $this->modele->getRessources($id_projet);
            $rendus = $this->modele->getRendus($id_projet);
            $soutenances = $this->modele->getSoutenances($id_projet);
            $groupes = $this->modele->getGroupesProjet($id_projet);
        }

        $this->vue->afficherFormulaireEdition($projet, $ressources, $rendus, $soutenances,$groupes);
    }
}