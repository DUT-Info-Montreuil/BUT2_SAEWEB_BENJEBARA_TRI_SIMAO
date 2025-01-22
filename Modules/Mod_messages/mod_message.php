<?php
require_once 'cont_message.php';

class ModMessage {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContMessage();
        $this->controleur->form();    
    }
}
?>