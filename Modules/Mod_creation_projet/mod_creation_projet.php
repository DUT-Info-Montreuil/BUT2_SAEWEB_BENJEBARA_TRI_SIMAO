<?php
require_once 'cont_creation_projet.php';

class ModCreationProjet {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContCreationProjet();
        $this->controleur->afficherFormulaire();


        if (isset($_POST['creer_projet'])) {
            $this->controleur->creerProjet();
        }
    }
}
?>