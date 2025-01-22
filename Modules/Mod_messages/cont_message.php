<?php
require_once 'modele_message.php';
require_once 'vue_message.php';
require_once 'connexion.php';

class ContMessage {
    private $modele;
    private $vue;

    public function __construct(){
        $this->modele = new ModeleMessage(); 
        $this->vue = new VueMessage();
    }

    public function form(){
        $this->vue->form_message();
    }

    public function envoyer_message() { 
           
    }
}
?>