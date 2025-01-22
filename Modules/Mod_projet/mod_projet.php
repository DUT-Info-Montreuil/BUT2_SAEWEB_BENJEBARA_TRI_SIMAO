<?php
require_once 'cont_projet.php';

class ModProjet {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContProjet();

        $action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $idProjet = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($action === 'liste') {
            $this->controleur->listeProjets();
        } else if ($action === 'view' && isset($_GET['id'])) {
            $this->controleur->voirProjet($idProjet);
        } else if ($action === 'demande_groupe') {
            $id_projet = isset($_POST['id_projet']) ? intval($_POST['id_projet']) : 0;
            $id_etudiant = isset($_POST['id_etudiant']) ? intval($_POST['id_etudiant']) : 0;
            $membres_groupe = isset($_POST['membres_groupe']) ? $_POST['membres_groupe'] : '';
            
            if ($id_projet && $id_etudiant && $membres_groupe) {
                $this->controleur->demandeGroupe($id_projet, $id_etudiant, $membres_groupe);
            } else {
                $this->controleur->vue->afficherErreur("Données manquantes pour la demande de groupe.");
            }
            }
    }
}