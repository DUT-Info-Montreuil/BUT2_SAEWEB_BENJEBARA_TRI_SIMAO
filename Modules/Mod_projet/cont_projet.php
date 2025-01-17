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

    public function afficherProjet($idProjet) {
        $projet = $this->modele->getProjet($idProjet);
        if ($projet) {
            $this->vue->afficherDetailsProjet($projet);
        } else {
            $this->vue->afficherErreur("Projet non trouvé.");
        }
    }
}