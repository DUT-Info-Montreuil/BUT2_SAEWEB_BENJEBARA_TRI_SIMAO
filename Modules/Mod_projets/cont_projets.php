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
        session_start();
        $id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;
        $projets = $this->modele->getProjets($id_utilisateur); // Passe l'ID utilisateur au modèle
        $isEnseignant = isset($_SESSION['id_utilisateur']) ? 
        $this->modele->isEnseignant($_SESSION['id_utilisateur']) : false;
        $this->vue->afficherListeProjets($projets, $isEnseignant);
    }
}
?>