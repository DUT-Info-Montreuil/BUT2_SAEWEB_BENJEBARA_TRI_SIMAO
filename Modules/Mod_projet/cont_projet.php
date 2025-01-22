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

    public function listeProjets() {
        session_start();
        $id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;
        $projets = $this->modele->getProjets($id_utilisateur);
        $isEnseignant = isset($_SESSION['id_utilisateur']) ?
            $this->modele->isEnseignant($_SESSION['id_utilisateur']) : false;
        $this->vue->afficherListeProjets($projets, $isEnseignant);
    }

    public function voirProjet($id_projet) {
        session_start();
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $projet = $this->modele->getProjet($id_projet);
        $ressources = $this->modele->getRessources($id_projet);
        $rendus = $this->modele->getRendus($id_projet);
        $soutenances = $this->modele->getSoutenances($id_projet);
        $groupes = $this->modele->getGroupesProjet($id_projet);
        $isEnseignant = isset($_SESSION['id_utilisateur']) ?
        $this->modele->isEnseignant($_SESSION['id_utilisateur']) : false;

        $etudiant = $this->modele->getEtudiantParUtilisateur($id_utilisateur);
        $etudiants = $this->modele->getEtudiantsParSemestre($projet['id_semestre']);
        $etudiantsSansGroupe = $this->modele->getEtudiantsSansGroupe($projet['id_semestre']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'envoyer_demande_groupe') {
            if (!$etudiant['id_groupe'] && !empty($_POST['membres_noms'])) {
                $noms = array_map('trim', explode(',', $_POST['membres_noms']));
                $membres_ids = [];
                
                foreach ($noms as $nom) {
                    $etudiant = $this->modele->getEtudiantParNom($nom, $projet['id_semestre']);
                    if ($etudiant && $etudiant['id_etudiant'] != $etudiantConnecte['id_etudiant']) {
                        $membres_ids[] = $etudiant['id_etudiant'];
                    }
                }
                
                if (!empty($membres_ids)) {
                    $this->modele->envoyerDemandeGroupe($id_projet, $etudiantConnecte['id_etudiant'], $membres_ids);
                    echo "Demande envoyée.";
                } else {
                    echo "Aucun étudiant valide trouvé.";
                }
            }
        }
        if ($etudiant) {
            $notes = $this->modele->getNotesByEtudiant($etudiant['id_etudiant']);
        } else {
            $notes = [];
        }

        if ($projet) {
            $this->vue->afficherDetailsProjet($projet, $ressources, $rendus, $soutenances, $groupes, $isEnseignant, $notes, $etudiant, $etudiants, $etudiantsSansGroupe);
        } else {
            $this->vue->afficherErreur("Projet non trouvé.");
        }
    }
}