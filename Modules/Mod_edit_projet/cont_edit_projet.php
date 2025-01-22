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

        if (!$projet = $this->modele->getProjet($id_projet)) {
            $this->vue->afficherErreur("Projet non trouvé");
            return;
        }
        $demandes = $this->modele->getDemandesGroupe($id_projet);

        $ressources = $this->modele->getRessources($id_projet);
        $rendus = $this->modele->getRendus($id_projet);
        $soutenances = $this->modele->getSoutenances($id_projet);
        $groupes = $this->modele->getGroupesProjet($id_projet);
        $etudiants = $this->modele->getEtudiantsParSemestre($projet['id_semestre']);
        $notes = array();
        foreach ($etudiants as $etudiant) {
            $notes = array_merge($notes, $this->modele->getStudentGrades($etudiant['id_etudiant']));
        }

        $responsables = $this->modele->getResponsablesProjet($id_projet);
        $enseignants = $this->modele->getAllEnseignants($id_projet);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'update_projet':
                        $nom = $_POST['nom'];
                        $description = $_POST['description'];
                        $this->modele->updateProjet($id_projet, $nom, $description);
                        break;

                    case 'add_ressource':
                        $titre = $_POST['titre'];
                        $type = $_POST['type'];
                        $lien = $_POST['lien'];
                        $id_utilisateur = $_SESSION['id_utilisateur'];
                        $id_enseignant = $this->modele->getEnseignantId($id_utilisateur);
                        $fichier = null;

                        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
                            $target_dir = "uploads/";
                            $target_file = $target_dir . basename($_FILES["fichier"]["name"]);

                            if (!is_dir($target_dir)) {
                                mkdir($target_dir, 0777, true);
                            }

                            if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
                                $fichier = $target_file;
                            }
                        }

                        if ($id_enseignant && $this->modele->addRessource($id_projet, $id_enseignant, $titre, $type, $lien, $fichier)) {
                            $ressources = $this->modele->getRessources($id_projet);
                        }
                        break;

                    case 'add_rendu':
                        $nom = $_POST['nom'];
                        $description = $_POST['description'];
                        $date_limite = $_POST['date_limite'];
                        $this->modele->addRendu($id_projet, $nom, $description, $date_limite);
                        break;

                    case 'add_soutenance':
                        $id_groupe = $_POST['id_groupe'];
                        $date_soutenance = $_POST['date_soutenance'];
                        $titre = $_POST['titre'];
                        $this->modele->addSoutenance($id_projet, $id_groupe, $date_soutenance, $titre);
                        break;

                    case 'add_student_to_group':
                        $id_etudiant = $_POST['id_etudiant'];
                        $id_groupe = $_POST['id_groupe'];
                        $this->modele->addStudentToGroup($id_etudiant, $id_groupe);
                        break;

                    case 'remove_student_from_group':
                        $id_etudiant = $_POST['id_etudiant'];
                        $id_groupe = $_POST['id_groupe'];
                        $this->modele->removeStudentFromGroup($id_etudiant, $id_groupe);
                        break;

                    case 'add_grade':
                        $id_etudiant = $_POST['id_etudiant'];
                        $id_groupe = isset($_POST['id_groupe']) ? (int)$_POST['id_groupe'] : null;
                        $note = $_POST['note'];
                        $type_evaluation = $_POST['type_evaluation'];
                        $coef = $_POST['coef'];
                        $this->modele->addGrade($id_etudiant, $id_groupe, $note, $type_evaluation, $coef);
                        break;

                    case 'edit_grade':
                        $id_note = $_POST['id_note'];
                        $new_grade = $_POST['new_grade'];
                        $this->modele->updateGrade($id_note, $new_grade);
                        break;

                    case 'delete_grade':
                        $id_note = $_POST['id_note'];
                        $this->modele->deleteGrade($id_note);
                        break;

                    case 'create_group':
                        $id_projet = $_POST['id_projet'];
                        $nom_groupe = $_POST['nom_groupe'];
                        $this->modele->createGroup($id_projet, $nom_groupe);
                        break;
                    case 'add_responsable':
                        $id_enseignant = $_POST['id_enseignant'];
                        $this->modele->addResponsable($id_enseignant, $id_projet);
                        break;
                        
                    case 'remove_responsable':
                        $id_responsable = $_POST['id_responsable'];
                        $this->modele->removeResponsable($id_responsable);
                        break;
                    case 'accepter_demande':
                       $id_demande = $_POST['id_demande'];
                       $membres = explode(',', $_POST['membres']);
                       $membres[] = $this->modele->getEtudiantIdParDemande($id_demande);
                                    
                       $nomGroupe = "Groupe " . uniqid();
                       $this->modele->createGroup($id_projet, $nomGroupe);
                       $id_groupe = $this->db->lastInsertId();
                                    
                       foreach ($membres as $id_etudiant) {
                           $this->modele->addStudentToGroup($id_etudiant, $id_groupe);
                       }
                       
                       $this->modele->supprimerDemande($id_demande);
                       break;              
                    default:
                        break;
                }
            }

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
            $responsables = $this->modele->getResponsablesProjet($id_projet);
            $enseignants = $this->modele->getAllEnseignants($id_projet);
        }

        $this->vue->afficherFormulaireEdition($projet, $ressources, $rendus, $soutenances, $groupes, $etudiants, $notes, $responsables, $enseignants, $demandes);
    }
}
?>
