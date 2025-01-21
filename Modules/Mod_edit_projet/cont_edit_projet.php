<?php
require_once 'modele_edit_projet.php';
require_once 'vue_edit_projet.php';

class ContEditProjet {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleEditProjet();
        $this->vue = new VueEditProjet();
    }

    public function editProjet($id_projet) {
        session_start();

        $projet = $this->modele->getProjet($id_projet);
        $ressources = $this->modele->getRessources($id_projet);
        $rendus = $this->modele->getRendus($id_projet);
        $soutenances = $this->modele->getSoutenances($id_projet);
        $groupes = $this->modele->getGroupesProjet($id_projet);
        $etudiants = $this->modele->getEtudiantsParSemestre($projet['id_semestre']);
        $notes = array();
        foreach ($etudiants as $etudiant) {
            $notes = array_merge($notes, $this->modele->getStudentGrades($etudiant['id_etudiant']));
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $projet = $this->modele->getProjet($id_projet);
            $ressources = $this->modele->getRessources($id_projet);
            $rendus = $this->modele->getRendus($id_projet);
            $soutenances = $this->modele->getSoutenances($id_projet);
            $groupes = $this->modele->getGroupesProjet($id_projet);
            $etudiants = $this->modele->getEtudiantsParSemestre($projet['id_semestre']);
            $notes = array();
            foreach ($etudiants as $etudiant) {
                $notes = array_merge($notes, $this->modele->getStudentGrades($etudiant['id_etudiant']));
            }
        }

        if (!$projet) {
            $this->vue->afficherErreur("Projet non trouvé");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle actions (update, delete, etc.)
            if (isset($_POST['action']) && $_POST['action'] === 'update_projet') {
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $this->modele->updateProjet($id_projet, $nom, $description);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_ressource') {
                $titre = $_POST['titre'];
                $type = $_POST['type'];
                $lien = $_POST['lien'];
                $id_utilisateur = $_SESSION['id_utilisateur'];
                $id_enseignant = $this->modele->getEnseignantId($id_utilisateur);

                if ($id_enseignant && $this->modele->addRessource($id_enseignant, $titre, $type, $lien)) {
                    $ressources = $this->modele->getRessources($id_projet);
                }
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_rendu') {
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $date_limite = $_POST['date_limite'];
                $this->modele->addRendu($id_projet, $nom, $description, $date_limite);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_soutenance') {
                $id_groupe = $_POST['id_groupe'];
                $date_soutenance = $_POST['date_soutenance'];
                $titre = $_POST['titre'];
                $this->modele->addSoutenance($id_projet, $id_groupe, $date_soutenance, $titre);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_student_to_group') {
                $id_etudiant = $_POST['id_etudiant'];
                $id_groupe = $_POST['id_groupe'];
                $this->modele->addStudentToGroup($id_etudiant, $id_groupe);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'remove_student_from_group') {
                $id_etudiant = $_POST['id_etudiant'];
                $id_groupe = $_POST['id_groupe'];
                $this->modele->removeStudentFromGroup($id_etudiant, $id_groupe);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'add_grade') {
                $id_etudiant = $_POST['id_etudiant'];
                $id_groupe = $_POST['id_groupe'];
                $note = $_POST['note'];
                $type_evaluation = $_POST['type_evaluation'];
                $coef = $_POST['coef'];
                $this->modele->addGrade($id_etudiant, $id_groupe, $note, $type_evaluation, $coef);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'edit_grade') {
                $id_note = $_POST['id_note'];
                $new_grade = $_POST['new_grade'];
                $this->modele->updateGrade($id_note, $new_grade);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'delete_grade') {
                $id_note = $_POST['id_note'];
                $this->modele->deleteGrade($id_note);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'create_group') {
                $id_projet = $_POST['id_projet'];
                $nom_groupe = $_POST['nom_groupe'];
                $this->modele->createGroup($id_projet, $nom_groupe);
            }

            // Refetch data after update/delete
            $projet = $this->modele->getProjet($id_projet);
            $ressources = $this->modele->getRessources($id_projet);
            $rendus = $this->modele->getRendus($id_projet);
            $soutenances = $this->modele->getSoutenances($id_projet);
            $groupes = $this->modele->getGroupesProjet($id_projet);
            $etudiants = $this->modele->getEtudiantsParSemestre($projet['id_semestre']);
            $notes = array();
            foreach ($etudiants as $etudiant) {
                $notes = array_merge($notes, $this->modele->getStudentGrades($etudiant['id_etudiant']));
            }
        }

        $this->vue->afficherFormulaireEdition($projet, $ressources, $rendus, $soutenances, $groupes, $etudiants, $notes);
    }
}