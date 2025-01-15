<?php
require_once 'modele_connexion.php';
require_once 'vue_connexion.php';
require_once 'connexion.php';

class ContConnexion {
    private $modele;
    private $vue;

    public function __construct(){
        $this->modele = new ModeleConnexion(); 
        $this->vue = new VueConnexion();
        $this->ouAller();
    }

    public function ouAller() {
        switch ($_GET['truc']) {
            case "redirect":
                $this->vue->connecte();
                break;
            
            default:
                # code...
                break;
        }
    }

    public function form(){
        $this->vue->form_inscription();
    }

    public function ajout_data() {
        if (isset($_POST['id_utilisateur'], $_POST['mot_de_pass'])) {
            
            $id = $_POST['id_utilisateur'];
            $passwd = $_POST['mot_de_pass'];
            $verdict = $this->modele->connecter_util($id, $passwd);
            
            if ($verdict = true) {
                $this->vue->confirmation_ajout();
            }    

        }    
    }
}
?>