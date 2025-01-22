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

        if ($etudiant) {
            $notes = $this->modele->getNotesByEtudiant($etudiant['id_etudiant']);
        } else {
            $notes = [];
        }

        if ($projet) {
            $this->vue->afficherProjet($projet, $ressources, $rendus, $soutenances, $groupes, $notes, $etudiant, $etudiants, $isEnseignant);
        } else {
            $this->vue->afficherErreur("Projet non trouvé.");
        }
    }

    public function demandeGroupe($id_projet, $id_etudiant, $membres_groupe_texte) {
        // Nettoyer la chaîne des membres du groupe
        $membres_groupe_texte = trim($membres_groupe_texte);
    
        // Vérifier si la chaîne n'est pas vide
        if (empty($membres_groupe_texte)) {
            $this->vue->afficherErreur("Veuillez entrer les noms et prénoms des membres du groupe.");
            return;
        }
    
        // Enregistrer la demande de groupe dans le modèle
        $resultat = $this->modele->creerDemandeGroupe($id_projet, $id_etudiant, $membres_groupe_texte);
    
        if ($resultat) {
            $this->vue->afficherMessage("Demande de groupe envoyée avec succès.");
        } else {
            $this->vue->afficherErreur("Erreur lors de l'envoi de la demande de groupe.");
        }
    }
    
}