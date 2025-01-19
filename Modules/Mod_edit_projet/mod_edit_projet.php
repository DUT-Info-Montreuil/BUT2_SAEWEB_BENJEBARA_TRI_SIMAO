<?php
require_once 'cont_edit_projet.php';

class ModEditProjet {
    private $controleur;

    public function __construct($id_projet = null) {
        $this->controleur = new ContEditProjet();

        if ($id_projet) {
            $this->controleur->editProjet($id_projet);
        } else {
            echo "ID du projet manquant.";
        }
    }
}
?>