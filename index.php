<?php
include_once 'Modules/Mod_connexion/mod_connexion.php';
include_once 'Modules/Mod_projets/mod_projets.php';
include_once 'Modules/Mod_projet/mod_projet.php';
include_once 'Modules/Mod_creation_projet/mod_creation_projet.php';
include_once 'Modules/Mod_edit_projet/mod_edit_projet.php'; 
function nettoyerEntree($donnee) {
    return htmlspecialchars(strip_tags($donnee));
}

$module = isset($_GET['module']) ? nettoyerEntree($_GET['module']) : 'connexion';
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
                header("Location: index.php?module=projets");
                exit;
            }
            break;
    default:
        die("Module inconnu");
}
?>