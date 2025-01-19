<?php
require_once 'cont_projet.php';

class ModProjet {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContProjet();

        $action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $idProjet = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'liste':
                $this->controleur->listeProjets();
                break;
            case 'view':
                if (isset($_GET['id'])) {
                    $this->controleur->voirProjet($idProjet);
                } else {
                    echo "ID du projet non spécifié.";
                }
                break;
            default:
                echo "Action invalide.";
                break;
        }
    }
}