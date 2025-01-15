<?php
require_once 'cont_acceuil.php';

class ModHome {
    private $controleur;

    public function __construct() {
        $this->controleur = new ContHome();  
        $this->controleur->form();
    }
}
?>