<?php
// Inclusions des modules - Chemins corrigés
include_once 'Modules/Mod_connexion/mod_connexion.php';
include_once 'Modules/Mod_projets/mod_projets.php';
include_once 'Modules/Mod_projet/mod_projet.php'; // Chemin corrigé pour mod_projet
include_once 'Modules/Mod_creation_projet/mod_creation_projet.php';
include_once 'Modules/Mod_edit_projet/mod_edit_projet.php'; // Chemin corrigé pour cont_creation_projet
include_once 'Modules/Mod_messages/mod_message.php';
// Fonction de nettoyage (sécurité)
function nettoyerEntree($donnee) {
    return htmlspecialchars(strip_tags($donnee));
}

// Récupération du module, de l'action et de l'ID
$module = isset($_GET['module']) ? nettoyerEntree($_GET['module']) : 'connexion'; // Module par défaut : home
$action = isset($_GET['action']) ? nettoyerEntree($_GET['action']) : '';
$id = isset($_GET['id']) ? nettoyerEntree($_GET['id']) : null;

// Routage
switch ($module) {
    case 'connexion':
        $modConnexion = new ModConnexion();
        break;
    case 'projets':
        $modProjets = new ModProjets();
        break;
    case 'creation_projet':
        $modCreationProjet = new ModCreationProjet;
        break;
    case 'projet':
        if ($action === 'view' && $id !== null) {
            $modProjet = new ModProjet();
        } else {
            // Rediriger vers la liste des projets si action/id manquant ou invalide
            header("Location: index.php?module=projets");
            exit;
        }
        break;
    case 'deconnexion':
        require_once 'Modules/Mod_connexion/deconnexion.php';
        break;
    case 'edit_projet':
            if ($id !== null) {
                $modEditProjet = new ModEditProjet($id);
            } else {
                // Rediriger vers la liste des projets si l'id est manquant
                header("Location: index.php?module=projets");
                exit;
            }
            break;
    default:
        // On pourrais afficher une page d'erreur 404 ici
        die("Module inconnu");
}
?>