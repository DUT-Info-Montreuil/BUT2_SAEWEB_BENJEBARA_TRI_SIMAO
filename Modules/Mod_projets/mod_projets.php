<?php
require_once 'cont_projets.php';

class ModProjets {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContProjets();
        $this->controleur->listeProjets();
    }
}