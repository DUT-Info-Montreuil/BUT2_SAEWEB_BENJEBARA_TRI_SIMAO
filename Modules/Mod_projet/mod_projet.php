<?php
require_once 'cont_projet.php';

class ModProjet {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContProjet();

        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $idProjet = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'view':
                if ($idProjet > 0) {
                    $this->controleur->afficherProjet($idProjet);
                } else {
                    echo "ID du projet invalide.";
                }
                break;
            default:
                echo "Action non reconnue.";
                break;
        }
    }
}