<?php
require_once 'cont_connexion.php';

class ModConnexion {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContConnexion();
        $this->controleur->form();
        if (isset($_GET['action'])) {
            $action = htmlspecialchars(strip_tags($_GET['action'])); 
            
            switch ($action) {
                case 'ajout':
                    $this->controleur->ajout_data(); 
                    break;
                    case 'hash_passwords':
                    $this->controleur->hashAllPasswords();
                    break;
                default:
                    echo "Action non valide";
                    break;
            }
        }    
    }
}
?>