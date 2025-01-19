<?php
require_once 'modele_projet.php';
require_once 'vue_projet.php';

class ContProjet {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleProjet();
        $this->vue = new VueProjet();
    }

    public function listeProjets() {
        session_start();
        $id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;
        $projets = $this->modele->getProjets($id_utilisateur); // Passe l'ID utilisateur au modèle
        $isEnseignant = isset($_SESSION['id_utilisateur']) ? 
        $this->modele->isEnseignant($_SESSION['id_utilisateur']) : false;
        $this->vue->afficherListeProjets($projets, $isEnseignant);
    }
    public function voirProjet($id_projet) {
        $projet = $this->modele->getProjet($id_projet);
        $ressources = $this->modele->getRessources($id_projet);
        $rendus = $this->modele->getRendus($id_projet);
        $soutenances = $this->modele->getSoutenances($id_projet);
        $groupes = $this->modele->getGroupesProjet($id_projet); 
        $isEnseignant = isset($_SESSION['id_utilisateur']) ? 
            $this->modele->isEnseignant($_SESSION['id_utilisateur']) : false;
        
        if ($projet) {
            $this->vue->afficherDetailsProjet($projet, $ressources, $rendus, $soutenances, $groupes, $isEnseignant);
        } else {
            $this->vue->afficherErreur("Projet non trouvé.");
        }
    }
}