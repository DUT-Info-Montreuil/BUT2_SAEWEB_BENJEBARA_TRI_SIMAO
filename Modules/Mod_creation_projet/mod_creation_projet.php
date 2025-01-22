<?php
require_once 'cont_creation_projet.php';

class ModCreationProjet {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContCreationProjet();

        if (isset($_POST['creer_projet'])) {
            $this->controleur->creerProjet();
        } else {
            $this->controleur->afficherFormulaire();
        }
    }
}
?>