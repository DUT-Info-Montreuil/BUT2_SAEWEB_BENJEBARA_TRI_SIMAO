<?php
include_once 'Modules/Mod_connexion/mod_connexion.php';
include_once 'Modules/Mod_home/mod_acceuil.php';

echo "<a href='index.php?module=connexion'>Module Connexion</a><br>";

function nettoyerModule($module) {
    return htmlspecialchars(strip_tags($module));
}

$module = isset($_GET['module']) ? nettoyerModule($_GET['module']) : 'default';
if(isset($_GET['module'])){
    switch ($module) {
        case 'connexion':
            $modConnexion= new ModConnexion;
            break;  
        case 'home':
            $modHome= new ModHome;
            break;
        default:
            die("Module inconnu");
    }
}

?>
