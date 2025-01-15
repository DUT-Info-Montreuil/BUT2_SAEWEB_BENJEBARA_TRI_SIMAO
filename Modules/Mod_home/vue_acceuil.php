<?php

    class VueHome {

        public function __construct(){}

        public function form_inscription(){
            ?>
                <h2>Bienvenue sur SAE Manager!</h2>
            <?php
        }

        public function confirmation_ajout() {
            echo '<p>Vous avez bien été connecté et enregistré !</p>';
        }

        public function connecte(){
            echo "je suis connecte";
        }
    }
?>