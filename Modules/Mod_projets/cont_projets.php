<?php
require_once 'modele_projets.php';
require_once 'vue_projets.php';

class ContProjets {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleProjets();
        $this->vue = new VueProjets();
    }

    public function listeProjets() {
        $projets = $this->modele->getProjets();
        $this->vue->afficherListeProjets($projets);
    }
}
?>