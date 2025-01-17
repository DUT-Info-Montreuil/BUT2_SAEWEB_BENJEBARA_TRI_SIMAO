<?php

    class VueConnexion {

        public function __construct(){}

        public function form_inscription(){
            ?>
                <form action='index.php?module=connexion&action=ajout&truc=redirect' method='post'>
                <input type='text' placeholder='identifiant' name='id' maxlength='50' required>
                <input type='password' placeholder='mot de passe' name='passwd' maxlength='255' required>
                <a href =''> vous êtes nouveau(elle)? </a>
                <input id='envoie' type='submit' value='se connecter'/>
                </form>";
            <?php
        }

        public function confirmation_ajout() {
            echo '<p>Vous avez bien été connecté et enregistré !</p>';
        }

        public function connecte(){
            echo "je suis connecte";
            header("Location: index.php?module=home");
        }
    }
?>