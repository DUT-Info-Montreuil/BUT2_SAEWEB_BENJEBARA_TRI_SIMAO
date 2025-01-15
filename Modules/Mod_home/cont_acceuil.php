<?php
require_once 'modele_acceuil.php';
require_once 'vue_acceuil.php';
require_once 'connexion.php';

class ContHome {
    private $modele;
    private $vue;

    public function __construct(){
        $this->modele = new ModeleHome(); 
        $this->vue = new VueHome();
        $this->ouAller();
    }

    public function form(){
        $this->vue->form_inscription();
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
}
?>